<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

//use Redis;
//use Illuminate\Support\Facades\Redis;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        try {
            $perPage = $request['perPage'];
            $data = Product::latest()->paginate($perPage);
            $pages_count = ceil($data->total()/$perPage);
            $labels = [];
            for ($i=1; $i <= $pages_count; $i++){
                (array_push($labels,$i));
            }
            return response([
                "data"=>ProductResource::collection($data),
                "pages"=>$pages_count,
                "total"=> $data->total(),
                "labels"=> $labels,
                "title"=> 'محصولات',
                "tooltip_new"=> 'ثبت محصول جدید',

            ], 200);
        } catch (\Exception $exception) {
            return response($exception);

        }
    }

    public function latest()
    {

        try {
            $data = Product::all()->sortByDesc('id')->take(4);
            return response(ProductResource::collection($data), 200);
        } catch (\Exception $exception) {
            return response($exception);

        }
    }

    public function indexSite(Request $request)
    {
        // dd($request->all());
        try {
            $data = Product::whereHas('activeCategory')->with('category')->where('active', 1);
            if ($request['stock'] == 'true') {
                $data = $data->where('stock', '>', 0);
            }elseif ($request['stock'== 'limited']){
                $data = $data->where('stock', '>', 0)->where('stock','<',5);
            }
            if ($request['cat_ids'] != '') {
                $ids = explode(',', $request['cat_ids']);
                $data = $data->whereIn('product_category_id', $ids);

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
                        $data = $data->orderByDesc('id');
                        break;
                    }
                }
            }
            if ($request['sale'] == 'true') {
                $data = $data->orderByDesc('sale');

            }
            if ($request['limit'] != '') {
                $data = $data->skip(0)->take($request['limit']);
            }
            $data = $data->get();

            return response(ProductResource::collection($data), 200);
//            return response(new ProductResource($data), 200);
        } catch (\Exception $exception) {
            return response($exception);

        }
    }

    public function stockSite()
    {
        try {
//
            $data = Product::whereHas('activeCategory')->with('category')->where('active', 1)->where('stock', '>', 0)->latest()->get();

            return response(ProductResource::collection($data), 200);
//            return response(new ProductResource($data), 200);
        } catch (\Exception $exception) {
            return response($exception);

        }
    }

    public function latestSite()
    {
        try {
            $data = Product::whereHas('activeCategory')->with('category')->where('active', 1)->take(4)->latest()->get();
            return response(ProductResource::collection($data), 200);
        } catch (\Exception $exception) {
            return response($exception);

        }
    }

    public function show(Product $product)
    {
        try {

            $sizes = ProductSize::where('product_id', $product['id'])->where('stock', '>', 0)->get(['color_name', 'color_code']);
            $sizes = json_decode($sizes);
//            return $sizes;
            $colors = [];
            foreach ($sizes as $item) {
                array_push($colors, json_encode(['color_name' => $item->color_name, 'color_code' => $item->color_code]));
            }
            return response(['product' => new ProductResource($product), 'colors' => array_unique($colors)], 200);
        } catch (\Exception $exception) {
            return response($exception);
        }
    }

    public function getSizes($id, $color)
    {
        try {

            $data = ProductSize::where('product_id', $id)->where('color_name', $color)->where('stock', '>', 0)->get();
            return response($data, 200);

        } catch (\Exception $exception) {
            return response($exception);
        }
    }

    public function saveImages($requestImages, $productId)
    {
        try {
            $images = '';
            for ($i = 0; $i < count($requestImages); $i++) {
                if ($requestImages[$i][1]) {
                    $name = 'product_' . $productId . '_' . uniqid() . '.jpg';
                    $image_path = (new ImageController)->uploadImage($requestImages[$i][1], $name, 'images/');
//                    (new ImageController)->resizeImage('images/', $name);
                    $images = $images . '/' . $image_path . ',';
                } else if ($requestImages[$i][0]) {
                    $images = $images . $requestImages[$i][0] . ',';
                }
            }
            return $images;
        }catch (Exception $exception){
            return $exception;
        }
    }

    public function store(Request $request)
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
            $product = Product::create($request->except('sizes', 'images'));

            foreach ($request['sizes'] as $item) {
                ProductSize::create([
                    'product_id' => $product['id'],
                    'size' => $item['size'],
                    'dimensions' => $item['dimensions'],
                    'color_name' => $item['color_name'],
                    'color_code' => $item['color_code'],
                    'stock' => $item['stock'],
                    'sale' => 0,
                ]);

                $images = $this->saveImages($request['images'], $product['id']);
                $product->update(['images' => substr($images, 0, -1)]);

            };

            return response(new ProductResource($product), 201);
        } catch (\Exception $exception) {
            return response($exception);
        }
    }

    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all('title'),
            [
                'title' => 'required|unique:products,title,' . $product['id'],
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
            $product->update($request->except('sizes', 'images'));

            foreach ($request['sizes'] as $item) {
                if ($item['id']) {
                    ProductSize::find($item['id'])->update([
                        'size' => $item['size'],
                        'dimensions' => $item['dimensions'],
                        'color_name' => $item['color_name'],
                        'color_code' => $item['color_code'],
                        'stock' => $item['stock'],
                        'sale' => 0
                    ]);
                } else {
                    ProductSize::create([
                        'product_id' => $product['id'],
                        'size' => $item['size'],
                        'dimensions' => $item['dimensions'],
                        'color_name' => $item['color_name'],
                        'color_code' => $item['color_code'],
                        'stock' => $item['stock'],
                        'sale' => 0
                    ]);
                }
            }

            $images = $this->saveImages($request['images'], $product['id']);
            $product->update(['images' => substr($images, 0, -1)]);

            return response(new ProductResource($product), 200);
        } catch (\Exception $exception) {
            return response($exception);
        }
    }

    public function destroy(Product $product)
    {

        try {
            $product->sizes->each->delete();
            $product->delete();
            return response('product deleted', 200);
        } catch (\Exception $exception) {
            return response($exception);
        }
    }

    public function activeToggle(Product $product)
    {
        try {
            $product->update(['active' => !$product['active']]);
            return response(new ProductResource($product), 200);
        } catch (\Exception $exception) {
            return response($exception);
        }
    }
    public function updateOrder(Request $request, Product $product )
    {
        try {

            $product->update(['images' => substr($request['images'], 0, -1)]);
            return response(new ProductResource($product), 200);
        } catch (\Exception $exception) {
            return response($exception);
        }
    }

}
