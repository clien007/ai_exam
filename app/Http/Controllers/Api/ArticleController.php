<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\API\ArticleService;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    private $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function index()
    {
        $userType = Auth::user()->type;
        $response = $this->articleService->getArticlesForUser($userType);
        return response()->json($response);
    }

    public function store(Request $request)
    {
        $article = $this->articleService->createArticle($request);
        return response()->json($article, 201);
    }

    public function show(Article $article)
    {
        $article->load('writer', 'editor', 'company');
        return response()->json($article);
    }

    public function update(Request $request, Article $article)
    {
        $article = $this->articleService->updateArticle($request, $article);
        return response()->json($article);
    }

    public function publish(Request $request, Article $article)
    {
        $article = $this->articleService->publishArticle($article);
        return response()->json($article);
    }
}
