<?php

namespace App\Validators\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ArticleValidator
{
    public function validateStore(Request $request)
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

        return $validator;
    }

    public function validateUpdate(Request $request)
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

        return $validator;
    }
}
