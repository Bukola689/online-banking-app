<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
     public function __construct(UserService $userService)
    {
        //
    }

     public function logout(Request $request): jsonResponse
    {
        $user = $request->user();
        $user->tokens->delete();
        return $this->sendSuccess([
        ], "Logged Out Successfully");
    }
}
