<?php

namespace App\Http\Controllers;

use App\Http\Resources\TeacherResource;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    public function index()
    {
        try {
            $data = Teacher::all()->sortByDesc('id');
            return response(TeacherResource::collection($data), 200);
        } catch (\Exception $exception) {
            return response($exception);

        }
    }

//    public function latest()
//    {
//
//        try {
//            $data = Teacher::all()->sortByDesc('id')->take(3);
//            return response(TeacherResource::collection($data), 200);
//        } catch (\Exception $exception) {
//            return response($exception);
//
//        }
//    }

//    public function indexSite(Request $request)
//    {
//        // dd($request->all());
//        try {
//            $data = Teacher::where('active', 1);
//            if ($request['search'] != '') {
//                $data = $data->where('title', 'Like', '%' . $request['search'] . '%');
//            }
//            $data = $data->get();
//
//            return response($data, 200);
////            return response(new TeacherResource($data), 200);
//        } catch (\Exception $exception) {
//            return response($exception);
//
//        }
//    }

    public function latestSite()
    {
        try {
            $data = Teacher::where('active', 1)->take(4)->latest()->get();
            return response($data, 200);
        } catch (\Exception $exception) {
            return response($exception);

        }
    }

    public function show(Teacher $teacher)
    {
        try {
            return response(new TeacherResourse($teacher), 200);
        } catch (\Exception $exception) {
            return response($exception);
        }
    }

    public function store(Request $teacher)
    {
        $validator = Validator::make($request->all('title'),
            [
                'title' => 'required|unique:products,title',
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
            $data = Teacher::create($request->all());

            return response(new TeacherResource($data), 201);
        } catch (\Exception $exception) {
            return response($exception);
        }
    }

    public function update(Request $request, Teacher $teacher)
    {
        $validator = Validator::make($request->all('title'),
            [
                'title' => 'required|unique:teachers,title,' . $teacher['id'],
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

            $teacher->update($request->all());
            return response(new TeacherResource($teacher), 200);
        } catch (\Exception $exception) {
        }

        return response($exception);
    }

    public function destroy(Request $teacher)
    {
        $data = Teacher::findOrFail($request['id']);
        try {
            $data->delete();
            return response('teacher deleted', 200);
        } catch (\Exception $exception) {
            return response($exception);
        }
    }

    public function activeToggle(Teacher $teacher)
    {
        try {
            $teacher->update(['active' => !$teacher['active']]);
            return response(new TeacherResource($teacher), 200);
        } catch (\Exception $exception) {
            return response($exception);
        }
    }
}
