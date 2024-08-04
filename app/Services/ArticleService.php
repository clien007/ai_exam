<?php

namespace App\Services;

use App\Models\Article;
use App\Models\User;
use App\Models\Company;
use App\Validators\ArticleValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleService
{
    private $validator;

    public function __construct(ArticleValidator $validator)
    {
        $this->validator = $validator;
    }

    public function getAllArticles()
    {
        return Article::with('writer', 'editor', 'company')->orderBy('id', 'desc')->get();
    }

    public function getFormData()
    {
        return [
            'writers' => User::where('type', 'Writer')->get(),
            'editors' => User::where('type', 'Editor')->get(),
            'companies' => Company::where('status', 'Active')->get(),
        ];
    }

    public function storeArticle(Request $request)
    {
        $this->validator->validate($request);

        $request->merge(['status' => 'For Edit']);
        $this->assignUserType($request);

        Article::create($request->all());
    }

    public function updateArticle(Request $request, Article $article)
    {
        $this->validator->validate($request);
        $this->assignUserType($request);

        if ($request->action == 'publish') {
            $request->merge(['status' => 'Published', 'editor_id' => auth()->user()->id]);
        } elseif (Auth::user()->type == "Editor" && $article->status == "Published") {
            $request->merge(['status' => 'Published']);
        } else {
            $request->merge(['status' => 'For Edit']);
        }

        $article->update($request->all());
    }

    public function publishArticle(Article $article)
    {
        $article->update([
            'status' => 'Published',
            'editor_id' => auth()->user()->id,
        ]);
    }

    private function assignUserType(Request $request)
    {
        if (Auth::user()->type == "Writer") {
            $request->merge(['writer_id' => Auth::user()->id]);
        } else {
            $request->merge(['editor_id' => Auth::user()->id]);
        }
    }
}

