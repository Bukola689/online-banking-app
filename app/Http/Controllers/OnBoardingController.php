<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class OnBoardingController extends Controller
{
    public function setupPin(Request $request, UserService $userService)
    {
        $tthis->validate($request, [
            'pin' => ['required', 'string', 'min:4', 'max:4']
        ]);

        $user = $request->user();

        $userService->setupPin($user, $request->input('pin'));

        return $this->sendSuccess([], 'Pin is set Successsfully');
    }

}
