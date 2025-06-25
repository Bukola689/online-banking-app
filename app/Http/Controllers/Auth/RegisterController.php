<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __construct($request, UserService $userservice)
    {
        //
    }

    public function register(UserRequest $request)
    {
        $userDto = UserDto::FromApiFormRequest($request);
        $user = $this->userService->createUser($userDto);
        return response()->json([
            'user' =>$user,
            'success' => true,
            'message' => 'Registration Successfully'
        ]);
    }
}
