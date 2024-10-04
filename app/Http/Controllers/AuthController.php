<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    // Log in a user and return an API token
    public function login(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Find the user by email
        $user = User::where('email', $request->email)->first();

        // Check if user exists and if password is correct
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // Create an API token for the user
        $token = $user->createToken('authToken')->plainTextToken;

        // Return the user and token
        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }
}
