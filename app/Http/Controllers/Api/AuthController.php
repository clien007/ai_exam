<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\API\AuthService;
use App\Validators\API\AuthValidator;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $authService;
    private $authValidator;

    public function __construct(AuthService $authService, AuthValidator $authValidator)
    {
        $this->authService = $authService;
        $this->authValidator = $authValidator;
    }

    public function login(Request $request)
    {
        $errors = $this->authValidator->validateLogin($request);

        if ($errors) {
            return response()->json($errors, 400);
        }

        $token = $this->authService->authenticate($request);

        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json(['token' => $token]);
    }
}

