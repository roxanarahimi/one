<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleCategoryResource;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleCategoryController extends Controller
{
    public function index()
    {
        try {
            $data = ArticleCategory::all()->sortByDesc('id');
            return response(ArticleCategoryResource::collection($data), 200);
        } catch (\Exception $exception) {
            return response($exception->getMessage(), (integer)$exception->getCode());

        }
    }

    public function show(ArticleCategory $articleCategory)
    {
        try {
            return response(new ArticleCategoryResource($articleCategory), 200);
        } catch (\Exception $exception) {
//            return response($exception->getMessage(), (integer)$exception->getCode());
            return response([$exception->getMessage(), (integer)$exception->getCode()], 500);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all('title'),
            [
                'title' => 'required|unique:article_categories',
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
            $data = ArticleCategory::create($request->all());
            return response(new ArticleCategoryResource($data), 201);
        } catch (\Exception $exception) {
//            return response($exception->getMessage(), (integer)$exception->getCode());
            return response([$exception->getMessage(), (integer)$exception->getCode()], 500);
        }
    }

    public function update(Request $request,ArticleCategory $articleCategory)
    {
        $validator = Validator::make($request->all('title'),
            [
                'title' => 'required|unique:article_categories,title,' . $articleCategory['id'],
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
            $articleCategory->update($request->all());
            return response(new ArticleCategoryResource($articleCategory), 200);
        } catch (\Exception $exception) {
//            return response($exception->getMessage(), (integer)$exception->getCode());
            return response([$exception->getMessage(), (integer)$exception->getCode()], 500);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $data = ArticleCategory::findOrFail($request['id']);
            $data->articles->each->delete();
            $data->delete();
            return response("category and it's subsets deleted", 200);
        } catch (\Exception $exception) {
//            return response($exception->getMessage(), (integer)$exception->getCode());
            return response([$exception->getMessage(), (integer)$exception->getCode()], 500);
        }
    }

    public function activeToggle(ArticleCategory $articleCategory)
    {
        try {
            $articleCategory->update(['active' => !$articleCategory['active']]);
            return response(new ArticleCategoryResource($articleCategory), 200);
        } catch (\Exception $exception) {
//            return response($exception->getMessage(), (integer)$exception->getCode());
            return response([$exception->getMessage(), (integer)$exception->getCode()], 500);
        }
    }
}
