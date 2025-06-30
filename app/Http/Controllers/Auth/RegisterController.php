<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Dtos\UserDto;
use Illuminate\Http\JsonResponse;
use App\Services\UserService;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __construct(UserService $userService)
    {
        //
    }

    public function register(UserRequest $request): JsonResponse
    {
        $userDto = UserDto::FromApiFormRequest($request);
        $user = $this->userService->createUser($userDto);
        return $this->sendSuccess(['user'=> $user,
            'message' => 'User created successfully']);
    }
}
