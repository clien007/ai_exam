<?php

namespace App\Services\API;

use App\Models\Article;
use App\Models\User;
use App\Validators\API\ArticleValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleService
{
    private $validator;

    public function __construct(ArticleValidator $validator)
    {
        $this->validator = $validator;
    }

    public function getArticlesForUser($userType)
    {
        if ($userType === 'Writer') {
            return [
                'articlesForEdit' => Auth::user()->writtenArticles()->where('status', 'For Edit')->orderBy('id', 'desc')->take(2)->get(),
                'articlesPublished' => Auth::user()->writtenArticles()->where('status', 'Published')->orderBy('id', 'desc')->take(2)->get(),
            ];
        } else {
            return [
                'articlesForEdit' => Article::where('status', 'For Edit')->get(),
                'articlesPublished' => Article::where('status', 'Published')->get(),
            ];
        }
    }

    public function createArticle(Request $request)
    {
        $validator = $this->validator->validateStore($request);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $request->merge([
            'status' => 'For Edit',
            Auth::user()->type === 'Writer' ? 'writer_id' : 'editor_id' => Auth::user()->id,
        ]);

        return Article::create($request->all());
    }

    public function updateArticle(Request $request, Article $article)
    {
        $validator = $this->validator->validateUpdate($request);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $article->update($request->all());
        return $article;
    }

    public function publishArticle(Article $article)
    {
        $article->update([
            'status' => 'Published',
            'editor_id' => Auth::user()->id,
        ]);

        return $article;
    }
}
