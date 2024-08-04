<?php

namespace App\Services;

use App\Models\User;
use App\Validators\UserValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private $validator;

    public function __construct(UserValidator $validator)
    {
        $this->validator = $validator;
    }

    public function getAllUsers()
    {
        return User::orderBy('id', 'desc')->get();
    }

    public function storeUser(Request $request)
    {
        $this->validator->validateStore($request);

        $request->merge([
            'password' => Hash::make($request->password),
        ]);

        User::create($request->all());
    }

    public function updateUser(Request $request, User $user)
    {
        $this->validator->validateUpdate($request, $user->id);
        $user->update($request->all());
    }
}
