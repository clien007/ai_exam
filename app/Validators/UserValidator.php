<?php 

namespace App\Validators;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserValidator
{
    public function validateStore(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'type' => 'required',
            'status' => 'required',
        ]);
    }

    public function validateUpdate(Request $request, $userId)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($userId),
            ],
            'type' => 'required',
            'status' => 'required',
        ]);
    }
}
