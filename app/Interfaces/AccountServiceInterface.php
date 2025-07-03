<?php

namespace App\Interfaces;

interface AccountServiceIntgerface
{
   public function modelQuery(): Builder;

   public function createAccountNumber(UserDto $userDto): Account;

   public function getAccountByAccountNumber(): Builder;
}
