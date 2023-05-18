<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiTokenLoginRequest;
use App\Http\Requests\ApiTokenRegisterRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ApiTokenController extends Controller
{
    public function register(ApiTokenRegisterRequest $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password'=> 'required|string',
            'name'=> 'required|min:3'
        ]);

        if (User::where('email', $request->email)->exists()) {
            return response()->json(['error' => "User already register"], 409);
        }

        $user = User::create([

            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->created_at = now()->format('Y-m-d');
        $token = $user->createToken($request->token_name);

        return response()->json([
            'token' => $token->plainTextToken,
            'user' => $user
        ]);

    }

    public function login(ApiTokenLoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => "Invalid credentials"], 401);
        }

        $user->tokens()->where('name', $request->token_name)->delete();

        $token = $user->createToken($request->token_name);
        $response = response()->json([
            'token' => $token->plainTextToken,
            'user' => $user
        ]);

        return $response->header('Content-Type', 'application/json');

    }

    public function logout(Request $request)
    {
        if ($request->user()) {
            $request->user()->currentAccessToken()->delete();
        }


        return response(null, 204);
    }

}
