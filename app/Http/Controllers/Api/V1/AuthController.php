<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    
    public function register(RegisterRequest $request){

        $data = $request->validated();

        $user = User::create([
            'name'=>  $data['name'],
            'email'=> $data['email'],
            'password'=>Hash::make( $data['password'])
        ]);

        $token = JWTAuth::fromUser($user);
        
        return response()->json([
            'message' => 'Usuário registrado com sucesso',
            'data' => [
                'user' => new UserResource($user),
                'token' => $token
            ]
        ], 201);
    }

    public function login(LoginRequest $request){

        $credentials = $request->validated();

        if(!$token = JWTAuth::attempt($credentials)){
            return response()->json(['message' => "Credênciais invalidas"], 401);
        }

        $user = JWTAuth::user();

        return response()->json([
            'message' => 'Login realizado com sucesso',
            'data' => [
                'user' => new UserResource($user),
                'token' => $token
            ]
        ], 200);

    }


    public function profile(){ 
        return response()->json([
            'message' => 'Seu perfil',
            'data' => new UserResource(JWTAuth::user())], 200);
        }
    
    public function logout(){
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json(['message' => 'Logout realizado com Sucesso!!']);
    }

}
