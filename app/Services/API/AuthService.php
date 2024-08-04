<?php

namespace App\Services\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function authenticate(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return null;
        }

        return $user->createToken('Personal Access Token')->plainTextToken;
    }
}
