<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illumimate\Http\JsonResponse;
use App\Services\UserService;
use App\Http\Reqquest\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
     public function __construct(UserService $userService)
       {
         //
       }
       
    public function login(loginRequest $request)
    {   
        $credentials = $request->validated();

       // $user = User::query()->where('email', $credentials['email'])->first();

        if(!Auth::attempt(($credentials))) {
            return $this->sendError('this provided Credentials are in-correct');
        }

        $user = $request->user();

        $token = $user->createToken('auth-token')->plainText;

        return $this->sendSuccess([
            'user' => $user,
            'token' => $token,
            'message' => 'Logging Successfully'
        ]);
    }

    public function user(Request $request): jsonResponse
    {
        return $this->sendSuccess([
            'user' => $reuest->user(),
        ], "Authentcated User Retrieved Successfully");
    }
}
