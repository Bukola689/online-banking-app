<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Dtos\UserDto;
use App\Services\UserService;
use App\Interfaces\DtoInterface;
use App\Interfaces\UserInterface;
use App\Models\User;
use App\Http\Requests\ApiFormRequest;
use App\Http\Requests\ApiRequest;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __construct(Request $request, UserService $userservice)
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
