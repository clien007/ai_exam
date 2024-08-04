<?php

namespace App\Services;

use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class DashboardService
{
    public function getDashboardRedirect()
    {
        $user = Auth::user();

        if ($user->type === 'Editor') {
            return 'editor.dashboard';
        } elseif ($user->type === 'Writer') {
            return 'writer.dashboard';
        } else {
            return null;
        }
    }

    public function getWriterDashboardData($user)
    {
        return [
            'articlesForEdit' => $user->writtenArticles()->where('status', 'For Edit')->orderBy('id', 'desc')->get(),
            'articlesPublished' => $user->writtenArticles()->where('status', 'Published')->orderBy('id', 'desc')->get(),
        ];
    }

    public function getEditorDashboardData()
    {
        return [
            'articlesForEdit' => Article::where('status', 'For Edit')->orderBy('id', 'desc')->get(),
            'articlesPublished' => Article::where('status', 'Published')->orderBy('id', 'desc')->get(),
        ];
    }
}
