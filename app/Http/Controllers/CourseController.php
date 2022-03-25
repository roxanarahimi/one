<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        try {
            $data = Course::all()->sortByDesc('id');
            return response(CourseResource::collection($data), 200);
        } catch (\Exception $exception) {
            return response($exception);
        }
    }

    public function latest()
    {

        try {
            $data = Course::all()->sortByDesc('id')->take(3);
            return response(CourseResource::collection($data), 200);
        } catch (\Exception $exception) {
            return response($exception);

        }
    }

    public function indexSite(Request $request)
    {
        // dd($request->all());
        try {
            $data = Course::whereHas('activeCategory')->with('category')->where('active', 1);
            if ($request['stock'] == 'true') {
                $data = $data->where('stock', '>', 0);
            }
            if ($request['cat_ids'] != '') {
                $ids = explode(',', $request['cat_ids']);
                $data = $data->whereIn('Course_category_id', $ids);

            }
            if ($request['off'] == 'true') {
                $data = $data->where('off', '>', 0)->where('stock', '>', 0);

            }
            if ($request['search'] != '') {
                $data = $data->where('title', 'Like', '%' . $request['search'] . '%');

            }
            if ($request['sort'] != '') {
                switch ($request['sort']) {

                    case ('sale'):
                    {
                        $data = $data->orderByDesc('sale');
                        break;
                    }
                    case ('score'):
                    {
                        $data = $data->orderByDesc('score');
                        break;
                    }
                    case ('cheap'):
                    {
                        $data = $data->orderBy('price');
                        break;
                    }
                    case ('expensive'):
                    {
                        $data = $data->orderByDesc('price');
                        break;
                    }
                    case ('view'):
                    {
                        $data = $data->orderByDesc('view');
                        break;
                    }
                    default:
                    {
                        $data = $data->latest();
                        break;
                    }
                }
            }

            $data = $data->get();

            return response($data, 200);
//            return response(new CourseResource($data), 200);
        } catch (\Exception $exception) {
            return response($exception);

        }
    }

    public function stockSite()
    {
        try {
//
            $data = Course::whereHas('activeCategory')->with('category')->where('active', 1)->where('stock', '>', 0)->latest()->get();

            return response($data, 200);
//            return response(new CourseResource($data), 200);
        } catch (\Exception $exception) {
            return response($exception);

        }
    }

    public function latestSite()
    {
        try {
            $data = Course::whereHas('activeCategory')->with('category')->where('active', 1)->take(4)->latest()->get();
            return response($data, 200);
        } catch (\Exception $exception) {
            return response($exception);

        }
    }

    public function show(Course $course)
    {
        try {

            $sizes = CourseSize::where('Course_id', $course['id'])->where('stock', '>', 0)->get(['color_name', 'color_code']);
            $sizes = json_decode($sizes);
//            return $sizes;
            $colors = [];
            foreach ($sizes as $item) {
                array_push($colors, json_encode(['color_name' => $item->color_name, 'color_code' => $item->color_code]));
            }
            return response(['Course' => new CourseResource($course), 'colors' => array_unique($colors)], 200);
        } catch (\Exception $exception) {
            return response($exception);
        }
    }

    public function getSizes($id, $color)
    {
        try {

            $data = CourseSize::where('Course_id', $id)->where('color_name', $color)->where('stock', '>', 0)->get();
            return response($data, 200);

        } catch (\Exception $exception) {
            return response($exception);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all('title'),
            [
                'title' => 'required|unique:Courses,title',
            ],
            [
                'title.required' => 'لطفا عنوان را وارد کنید',
                'title.unique' => 'این عنوان قبلا ثبت شده است',
            ]
        );
        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }
        try {
//            return $request['sizes'];
            $data = Course::create($request->except('sizes'));

            foreach ($request['sizes'] as $item) {
                CourseSize::create([
                    'Course_id' => $data['id'],
                    'size' => $item['size'],
                    'dimensions' => $item['dimensions'],
                    'color_name' => $item['color_name'],
                    'color_code' => $item['color_code'],
                    'stock' => $item['stock'],
                    'sale' => 0,
                ]);


            };

            return response(new CourseResource($data), 201);
        } catch (\Exception $exception) {
            return response($exception);
        }
    }

    public function update(Request $request, Course $course)
    {
        $validator = Validator::make($request->all('title'),
            [
                'title' => 'required|unique:Courses,title,' . $course['id'],
            ],
            [
                'title.required' => 'لطفا عنوان را وارد کنید',
                'title.unique' => 'این عنوان قبلا ثبت شده است',
            ]
        );
        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }
        try {
            $course->update($request->except('sizes'));

            foreach ($request['sizes'] as $item) {
                if ($item['id']) {
                    CourseSize::find($item['id'])->update([
                        'size' => $item['size'],
                        'dimensions' => $item['dimensions'],
                        'color_name' => $item['color_name'],
                        'color_code' => $item['color_code'],
                        'stock' => $item['stock'],
                        'sale' => 0
                    ]);
                } else {
                    CourseSize::create([
                        'Course_id' => $course['id'],
                        'size' => $item['size'],
                        'dimensions' => $item['dimensions'],
                        'color_name' => $item['color_name'],
                        'color_code' => $item['color_code'],
                        'stock' => $item['stock'],
                        'sale' => 0
                    ]);
                }
            }

            return response(new CourseResource($course), 200);
        } catch (\Exception $exception) {
            return response($exception);
        }
    }

    public function destroy(Request $request)
    {
        $data = Course::findOrFail($request['id']);
        try {
            $data->sizes->each->delete();
            $data->delete();
            return response('Course deleted', 200);
        } catch (\Exception $exception) {
            return response($exception);
        }
    }

    public function activeToggle(Course $course)
    {
        try {
            $course->update(['active' => !$course['active']]);
            return response(new CourseResource($course), 200);
        } catch (\Exception $exception) {
            return response($exception);
        }
    }

}
