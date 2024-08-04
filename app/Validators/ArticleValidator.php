<?php

namespace App\Validators;

use Illuminate\Http\Request;

class ArticleValidator
{
    public function validate(Request $request)
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
    }
}

