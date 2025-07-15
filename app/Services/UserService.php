<?php

namespace App\Services;

use App\Dtos\UserDto;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\ModeNotFoundException;
use App\Exceptions\PinHasAlreadyBeenSetException;
use App\Exceptions\PinNotSetException;
use App\Interfaces\UserServiceInterface;
use App\Exceptions\InvalidPinLengthException;
use App\Interfaces\UserServiceIntegrface;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    public function createUser(UserDto $userDto): Model
    {
      return User::query()->create([
            'name' => $userDto->getName(),
            'email' => $userDto->getEmail(),
            'phone_number' => $userDto->getPhoneNumber(),
            'password' => $userDto->getPassword(),
        ]);
    }

       public function getUserById(int $userId): Model
    {
        $user = User::query()->where('id', $userId)->first();

        if (!$user) {
            throw new ModeNotFoundException('User Not Found');
        }

        return $user;
    }

      public function hasSetPin(User $user): bool
    {
        return $user->pin != null;
    }


    public function validatePin(int $userId, string $pin): bool
    {
        $user = $this->getUserById($userId);

        if(!$this->hasSetPin($user)) {
            throw new InvalidPinLengthException("Pin Has Already Been Set");
        }

        return Hash::check($pin, $user->pin);
    }

    public function setupPin(User $user, string $pin): void
    {
         if(!$this->hasSetPin($user)) {
            throw new InvalidPinLengthException("Pin Has Already Been Set");
        }

        if(strlen($pin) != 4) {
            throw new InvalidPinLengthException();
        }

        $user->pin = Hash::make($pin);
        $user->save();
    }
   


}