<?php

namespace App\Http\Controllers;

use Validator;
use App\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Firebase\JWT\ExpiredException;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Routing\Controller as BaseController;

class AuthController extends BaseController
{
    /**
     * The request instance.
     *
     * @var \Illuminate\Http\Request
     */
    private $request;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
    */
    public function __construct(Request $request) {
        $this->request = $request;
    }
    /**
     * Create a new token.
     *
     * @param  \App\User   $user
     * @return string
     */
    protected function jwt(User $user) {
        $payload = [
            'iss' => "lumen-jwt", // Issuer of the token
            'sub' => $user->id, // Subject of the token
            'iat' => time(), // Time when JWT was issued.
            'exp' => time() + 60*60 // Expiration time
        ];

        // As you can see we are passing `JWT_SECRET` as the second parameter that will
        // be used to decode the token in the future.
        return JWT::encode($payload, env('JWT_SECRET'));
    }
    /**
     * Login de usuarios
     *
     * @param  \App\User   $user
     * @return mixed
     */
    public function login(User $user) {

        $this->validate($this->request, [
            'nombre'     => 'required',
            'clave'  => 'required'
        ]);

        // Find the user by username
        $user = User::where('username', $this->request->input('nombre'))->first();

        if(!$user){
            // Bad Request response
            return response()->json([
                'error' => 'Las credenciales no coinciden con un usuario del sistema.'
            ], 400);
        }

        // Verify the password and generate the token
        if (Hash::check($this->request->input('clave'), $user->password)) {
            return response()->json([
                'token' => $this->jwt($user)
            ], 200);
        }

    }
}