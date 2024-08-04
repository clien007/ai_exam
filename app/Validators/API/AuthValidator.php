<?php

namespace App\Validators\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthValidator
{
    public function validateLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        return null;
    }
}
