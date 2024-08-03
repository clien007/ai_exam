<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{

    public function index()
    {
        $articles = Article::with('writer', 'editor', 'company')->orderBy('id','desc')->get();
        return view('articles.index', compact('articles'));
    }
    
    public function create()
    {
        $writers = User::where('type', 'Writer')->get();
        $editors = User::where('type', 'Editor')->get();
        $companies = Company::where('status','Active')->get();
        return view('articles.create', compact('writers', 'editors', 'companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|url',
            'title' => 'required',
            'link' => 'required|url',
            'date' => 'required|date',
            'content' => 'required',
            'writer_id' => 'nullable|exists:users,id',
            'editor_id' => 'nullable|exists:users,id',
            'company_id' => 'required|exists:companies,id',
        ]);

        $request->merge(['status' => 'For Edit']);

        if(Auth::user()->type == "Writer"){
            $request->merge(['writer_id' => Auth::user()->id]);
        }else{
            $request->merge(['editor_id' => Auth::user()->id]);
        }
        Article::create($request->all());

        return redirect()->route('articles.index')->with('success', 'Article created successfully.');
    }

    public function show(Article $article){
        return view('articles.show',compact('article'));
    }

    public function edit(Article $article)
    {
        $user = Auth::user();
        if($user->type == 'Writer' && $article->status == 'Published'){
            return redirect()->route('main.dashboard');
        }
        $writers = User::where('type', 'Writer')->get();
        $editors = User::where('type', 'Editor')->get();
        $companies = Company::all();
        return view('articles.edit', compact('article', 'writers', 'editors', 'companies'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'image' => 'required|url',
            'title' => 'required',
            'link' => 'required|url',
            'date' => 'required|date',
            'content' => 'required',
            'writer_id' => 'nullable|exists:users,id',
            'editor_id' => 'nullable|exists:users,id',
            'company_id' => 'required|exists:companies,id',
        ]);

        if(Auth::user()->type == "Writer"){
            $request->merge(['writer_id' => Auth::user()->id]);
        }else{
            $request->merge(['editor_id' => Auth::user()->id]);
        }

        if ($request->action == 'publish') {
            $request->merge(['status' => 'Published']);
            $request->merge(['editor_id' => auth()->user()->id]);
        }else{
            if(Auth::user()->type == "Editor" && $article->status == "Published"){
                $request->merge(['status' => 'Published']);
            }else{
                $request->merge(['status' => 'For Edit']);
            }
        }

        $article->update($request->all());

        return redirect()->route('articles.index')->with('success', 'Article updated successfully.');
    }

    public function publish(Request $request, Article $article)
    {
        $article->update([
            'status' => 'Published',
            'editor_id' => auth()->user()->id,
        ]);

        return redirect()->route('articles.index')->with('success', 'Article published successfully.');
    }
}
