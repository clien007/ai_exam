<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Services\ArticleService;
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
        $articles = $this->articleService->getAllArticles();
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        $formData = $this->articleService->getFormData();
        return view('articles.create', $formData);
    }

    public function store(Request $request)
    {
        $this->articleService->storeArticle($request);
        return redirect()->route('articles.index')->with('success', 'Article created successfully.');
    }

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        $user = Auth::user();
        if ($user->type == 'Writer' && $article->status == 'Published') {
            return redirect()->route('main.dashboard');
        }

        $formData = $this->articleService->getFormData();
        return view('articles.edit', array_merge($formData, compact('article')));
    }

    public function update(Request $request, Article $article)
    {
        $this->articleService->updateArticle($request, $article);
        return redirect()->route('articles.index')->with('success', 'Article updated successfully.');
    }

    public function publish(Request $request, Article $article)
    {
        $this->articleService->publishArticle($article);
        return redirect()->route('articles.index')->with('success', 'Article published successfully.');
    }
}

