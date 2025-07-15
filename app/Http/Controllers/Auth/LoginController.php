<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\LoginRequest;
use App\Traits\ApiResponseTrait;
use App\Models\User;
use App\Dtos\UserDto;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use ApiResponseTrait;

     public function __construct(UserService $userService)
       {
          $this->userService = $userService;
       }
       
   public function login(LoginRequest $request)
  {
     $user = Auth::user();

    dd($user);

    $credentials = $request->validated();

    if (!Auth::check($credentials)) {
        return $this->sendError('The provided credentials are incorrect.');
    }

    $user = $request->user();

    $token = $user->createToken('myapptoken')->plainTextToken;

    return $this->sendSuccess([
        'user' => $user,
        'token' => $token
    ], 'Logged in successfully.');
  }


    public function user(Request $request): jsonResponse
    {
        return $this->sendSuccess([
            'user' => $reuest->user(),
        ], "Authentcated User Retrieved Successfully");
    }
}
