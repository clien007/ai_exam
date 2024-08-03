<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){

        $user = Auth::user();

        if ($user->type === 'Editor') {
            $redirect = 'editor.dashboard';
        }elseif($user->type === 'Writer'){
            $redirect = 'writer.dashboard';
        }else{
            return abort(404);
        }

        return redirect()->route($redirect);
    }

    
    public function writerDashboard()
    {
        $articlesForEdit = auth()->user()->writtenArticles()->where('status', 'For Edit')->orderBy('id','desc')->get();
        $articlesPublished = auth()->user()->writtenArticles()->where('status', 'Published')->orderBy('id','desc')->get();
        return view('writers.dashboard', compact('articlesForEdit', 'articlesPublished'));
    }

    public function editorDashboard()
    {
        $articlesForEdit = Article::where('status', 'For Edit')->orderBy('id','desc')->get();
        $articlesPublished = Article::where('status', 'Published')->orderBy('id','desc')->get();
        return view('editors.dashboard', compact('articlesForEdit', 'articlesPublished'));
    }
}
