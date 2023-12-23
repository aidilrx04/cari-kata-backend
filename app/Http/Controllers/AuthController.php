<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    //

    public function register(RegisterUserRequest $request)
    {

        $validated = $request->validated();

        // store user data
        $user = User::create([
            'username' => $validated['username'],
            'password' => Hash::make($validated['password'])
        ]);

        // create token
        $token = $user->createToken('API TOKEN')->plainTextToken;


        return response()->json([
            'data' => $user,
            'token' => $token
        ]);
    }

    public function login(LoginUserRequest $request)
    {
        $validated = $request->validated();

        $credentials = $request->validate([
            'username' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string']
        ]);

        if (!Auth::attempt([
            "username" => $request->username,
            'password' => $request->password
        ])) {
            throw new AuthenticationException('Invalid Credential');
        }

        $user = User::where("id", Auth::id())->get()->first();


        // create token
        $token = $user->createToken('API TOKEN')->plainTextToken;

        return response()->json([
            'data' => $user,
            'token' => $token
        ]);
    }
}
