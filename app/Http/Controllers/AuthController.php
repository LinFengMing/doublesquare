<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUser;
use App\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signup(CreateUser $request)
    {
        $data = $request->json()->all();
        $user = new User([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        $user->save();

        return response('success', 201);
    }

    public function login(Request $request)
    {
        $data = $request->json()->all();
        // $validatedData = $data->validate([
        //     'email' => 'required|string',
        //     'password' => 'required|string'
        // ]);
        // print_r($validatedData);
        $login = [
            'name' => $data['username'],
            'password' => $data['password']
        ];
        if(!Auth::attempt($login)) {
            $error = [
                'error' => '401'
                ];

            return response()->json($error);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Token');
        $tokenResult->token->save();

        return response(['token' => $tokenResult->accessToken]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response(['message' => '成功登出']);
    }

    public function user(Request $request)
    {
        return response($request->user());
    }
}
