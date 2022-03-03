<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    public function index()
    {
        try {
            $data = Article::all()->sortByDesc('id');
            return response(ArticleResource::collection($data), 200);
        } catch (\Exception $exception) {
            return response($exception->getMessage(), (integer)$exception->getCode());

        }
    }

    public function latest()
    {
        try {
            $data = Article::all()->sortByDesc('id')->take(3);
            return response(ArticleResource::collection($data), 200);
        } catch (\Exception $exception) {
            return response($exception->getMessage(), (integer)$exception->getCode());

        }
    }

    public function show(Article $article)
    {
        try {
            return response(new ArticleResource($article), 200);
        } catch (\Exception $exception) {
//            return response($exception->getMessage(), (integer)$exception->getCode());
            return response([$exception->getMessage(), (integer)$exception->getCode()], 500);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all('title'),
            [
                'title' => 'required|unique:articles,title',
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
            $data = Article::create($request->all());
            return response(new ArticleResource($data), 201);
        } catch (\Exception $exception) {
//            return response($exception->getMessage(), (integer)$exception->getCode());
            return response([$exception->getMessage(), (integer)$exception->getCode()], 500);
        }
    }

    public function update(Request $request,Article $article)
    {

        $validator = Validator::make($request->all('title'),
            [
                'title' => 'required|unique:articles,title,' . $article['id'],
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
            $article->update($request->all());
            return response(new ArticleResource($article), 200);
        } catch (\Exception $exception) {
//            return response($exception->getMessage(), (integer)$exception->getCode());
            return response([$exception->getMessage(), (integer)$exception->getCode()], 500);
        }
    }

//    public function destroy(Article $article)
    public function destroy(Request $request)
    {
        $data = Article::findOrFail($request['id']);
        try {
            $data->delete();
            return response('article deleted', 200);
        } catch (\Exception $exception) {
//            return response($exception->getMessage(), (integer)$exception->getCode());
            return response([$exception->getMessage(), (integer)$exception->getCode()], 500);
        }
    }

    public function activeToggle(Article $article)
    {

        try {
            $article->update(['active' => !$article['active']]);
            return response(new ArticleResource($article), 200);
        } catch (\Exception $exception) {
//            return response($exception->getMessage(), (integer)$exception->getCode());
            return response([$exception->getMessage(), (integer)$exception->getCode()], 500);
        }
    }
}
