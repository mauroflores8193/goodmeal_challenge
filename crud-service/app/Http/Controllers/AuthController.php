<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $token = Auth::user()->createToken("auth");
            return response()->json($token->plainTextToken);
        } else {
            return response()->json("Credenciales incorrectas.", 401);
        }
    }

}
