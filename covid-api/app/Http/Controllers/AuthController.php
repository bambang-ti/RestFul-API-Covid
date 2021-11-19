<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        /**
         * Fitur Register
         * Mengambil input name, email, password dari file User.php
         * Menginput data ke database menggunakan User Model
         */
        $input = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];
        $user = User::create($input);
        $data = [
            'message' => 'Register  is success',
        ];
        return response()->json($data, 200);
    
    }

    public function login(Request $request){
        /**
         * Fitur Login
         * Mengambil data input dari user berupa email dan password
         * Mengambil data akun dari database
         * Membandingkan data kedua nya dan membuat token
         */

         $input = [
             'email' => $request->email,
             'password' => $request->password
         ];

         $user = User::where('email', $input['email'])->first();

         if (Auth::attempt($input)){
             $token = $user->createToken('auth_token');

             $data = [
                 'message' => 'Login is success',
                 'token' => $token->plainTextToken
             ];

             return response()->json($data, 200);
         } else {
             $data = [
                 'message' => 'Login is invalid'
             ];
             return response()->json($data, 401);
         }
    }
}
