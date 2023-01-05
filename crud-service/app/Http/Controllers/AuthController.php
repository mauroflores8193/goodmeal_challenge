<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

/**
 * @OA\Info(title="API Usuarios", version="1.0")
 *
 * @OA\Server(url="http://localhost:8000")
 */
class AuthController extends Controller {

    /**
     * @OA\Post(
     *   path="/api/login",
     *   tags={"Obtener token de autorización"},
     *   description="Envia sus credenciales de acceso y obtendrá un token de autorización. Use el token para endpoints protedigos enviando en la cabecera de la petición: 'Authorization: Bearer YOUR_TOKEN'",
     *   @OA\RequestBody(
     *       required=true,
     *       description="The Token Request",
     *       @OA\JsonContent(
     *        @OA\Property(property="email",type="string",example="mflores@gmail.com"),
     *        @OA\Property(property="password",type="string",example="password"),
     *       )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="TOKEN",
     *   ),
     *   @OA\Response(response=401, description="Credenciales incorrectas.")
     * )
     */
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
