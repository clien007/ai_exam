<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {
        if(Auth::user()->type == "Writer"){
            $articlesForEdit = auth()->user()->writtenArticles()->where('status', 'For Edit')->orderBy('id','desc')->take(2)->get();
            $articlesPublished = auth()->user()->writtenArticles()->where('status', 'Published')->orderBy('id','desc')->take(2)->get();
        }else{
            $articlesForEdit = Article::where('status', 'For Edit')->get();
            $articlesPublished = Article::where('status', 'Published')->get();
        }

        $response = [
            'articlesForEdit' => $articlesForEdit,
            'articlesPublished' => $articlesPublished
        ];

        return response()->json($response);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|url',
            'title' => 'required|string|max:255',
            'link' => 'required|url',
            'date' => 'required|date',
            'content' => 'required|string',
            'status' => 'required|in:For Edit,Published',
            'writer_id' => 'required|exists:users,id',
            'editor_id' => 'nullable|exists:users,id',
            'company_id' => 'required|exists:companies,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $request->merge(['status' => 'For Edit']);

        if(Auth::user()->type == "Writer"){
            $request->merge(['writer_id' => Auth::user()->id]);
        }else{
            $request->merge(['editor_id' => Auth::user()->id]);
        }

        $article = Article::create($request->all());

        return response()->json($article, 201);
    }

    public function show(Article $article)
    {
        $article->load('writer', 'editor', 'company');
        return response()->json($article);
    }

    public function update(Request $request, Article $article)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|url',
            'title' => 'required|string|max:255',
            'link' => 'required|url',
            'date' => 'required|date',
            'content' => 'required|string',
            'status' => 'required|in:For Edit,Published',
            'writer_id' => 'required|exists:users,id',
            'editor_id' => 'nullable|exists:users,id',
            'company_id' => 'required|exists:companies,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $article->update($request->all());

        return response()->json($article);
    }

    public function publish(Request $request, Article $article)
    {
        $article->update([
            'status' => 'Published',
            'editor_id' => auth()->user()->id,
        ]);

        return response()->json($article);
    }
}
