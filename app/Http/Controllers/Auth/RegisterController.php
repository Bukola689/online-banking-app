<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Dtos\UserDto;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use App\Services\UserService;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
     use ApiResponseTrait;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(UserRequest $request,UserService $userService): JsonResponse
    {
        $userDto = UserDto::FromApiFormRequest($request);
        $user = $this->userService->createUser($userDto);
        return $this->sendSuccess(['user'=> $user,], 'Register Successfull');
    }
}
