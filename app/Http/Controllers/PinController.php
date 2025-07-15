<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Service\UserService;
use Illuminate\Http\Request;

class PinController extends Controller
{
     public function setupPin(Request $request, UserService $userService)
    {
        $tthis->validate($request, [
            'pin' => ['required', 'string', 'min:4', 'max:4']
        ]);

        $user = $request->user();

        $userService->setupPin($user, $request->input('pin'));

        return new JsonResponse(['Pin is set Successsfully'], 400);
         
    }

     public function validatePin(Request $request, UserService $userService)
    {
        $tthis->validate($request, [
            'pin' => ['required', 'string']
        ]);

        $user = $request->user();

        $isValid = $userService->validatePin($user->id, $request->input('pin'));

         return response()->json(['is_valid' => $isValid], 'Pin Validated');
    }
}
