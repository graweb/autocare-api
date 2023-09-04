<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    /**
     * Login
     */
    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|string|email|max:100',
            'password' => 'required|string',
        ];

        $messages = [
            'email.required' => 'The :attribute field is required!',
            'email.email' => 'The :email field is required!',
            'email.max' => 'The :attribute must be :max characters!',
            'password.required' => 'The :attribute field is required!',
        ];

        $data = Validator::make($request->all(), $rules, $messages);

        if ($data->fails()) {
            return $data->errors();
        } else {

            $user = User::with(['customer'])->where('email', $data->validated()['email'])->first();

            if(!$user || !Hash::check($data->validated()['password'], $user->password)) {
                return response(['message' => 'The provided credentials are incorrect.']);
            }

            $token = $user->createToken(config('app.name'))->plainTextToken;

            return response([
                'user' => $user,
                'token' => $token,
            ], 201);
        }
    }

    /**
     * Logout
     */
    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response(['message' => 'Logout successfuly.'], 200);
    }

    /**
     * Check token
     */
    public function checkToken(Request $request)
    {
        $check = PersonalAccessToken::findToken($request->token);
        if(is_null($check)) {
            return response(['message' => 'Token expired.'], 401);
        }

        return response([
            'user' => $check->tokenable,
            'token' => $request->token
        ], 200);
    }
}
