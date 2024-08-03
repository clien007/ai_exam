<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    public function edit(User $user, Article $article)
    {
        return $user->id === $article->writer_id && $article->status == 'For Edit';
    }

    public function publish(User $user, Article $article)
    {
        return $user->type == 'Editor';
    }

}
