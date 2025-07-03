<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PinController extends Controller
{
     public function setupPin(Request $request, UserService $userService): JssonResponse
    {
        $tthis->validate($request, [
            'pin' => ['required', 'string', 'min:4', 'max:4']
        ]);

        $user = $request->user();

        $userService->setupPin($user, $request->input('pin'));

        return $this->sendSuccess([], 'Pin is set Successsfully');
    }

     public function validatePin(Request $request, UserService $userService): JsonResponse
    {
        $tthis->validate($request, [
            'pin' => ['required', 'string']
        ]);

        $user = $request->user();

        $isValid = $userService->validatePin($user->id, $request->input('pin'));

        return $this->sendSuccess(['is_valid' => $isValid], 'Pin Validated');
    }
}
