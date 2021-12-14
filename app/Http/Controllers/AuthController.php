<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

use App\Models\User;

class AuthController extends Controller
{
    // Registrar usuario
    public function register(Request $request){
        $this->validate($request, [
            'username' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'role' => 'required|min:4',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'steamUsername' => $request->steamUsername
        ]);

        $token = $user->createToken('LaravelAuthApp')->accessToken;

        return response()->json([
            'token' => $token,
            'user' => $user
        ], 200);
    }

    //Logear usuario
    public function login(Request $request){
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
}