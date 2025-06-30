<?php

namespace App\Services;

use App\Dtos\UserDto;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function createUser(UserDto $userDto): Model
    {
      return User::query()->create([
            'name' => $userData->getName(),
            'email' => $userData->getEmail(),
            'phone_number' => $userData->getPhoneNumber(),
            'password' => $userDto->getPassword(),
        ]);
    }
}