<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function adminRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'phone' => 'required|string|unique:users',
            'password' => 'required|string',
            'center_id' => 'required|exists:centers,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 422);
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->password = Hash::make($request->input('password'));
        $user->role = 'ADMIN';
        $user->center_id = $request->input('center_id');

        $user->save();

        return response()->json(['message' => 'Admin registered successfully'], 201);
    }

    public function studentRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'phone' => 'required|string|unique:users',

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 422);
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->role = 'STUDENT';
        $user->center_id = Auth::user()->center_id;
        $user->otp = $this->makeOTP();
        $user->save();

        return response()->json(['message' => 'Student registered successfully', 'user' => $user], 201);
    }
    private function makeOTP(): string
    {
        do {
            $otp = rand(100000, 999999);
            $exists = User::where('otp', $otp)->exists();
        } while ($exists);
    
        return (string) $otp;
    }

    public function AdminLogin(Request $request)
    {
        $validatedData = $request->validate([
            'phone' => 'required',
            'password' => 'required',
        ]);

        if (auth()->attempt(['phone' => $validatedData['phone'], 'password' => $validatedData['password']])) {
            $user = auth()->user();
            $token = $user->createToken('AuthToken')->plainTextToken;

            return response()->json(['message' => 'Login successful', 'role' => $user->role, 'token' => $token]);
        } else {
            return response()->json(['message' => 'Invalid credentials'], 400);
        }
    }
    public function studentLogin(Request $request)
    {
        $validatedData = $request->validate([
            'otp' => 'required|string',
        ]);

        $user = User::where('otp', $validatedData['otp'])->first();

        if ($user) {
            auth()->login($user);
            $token = $user->createToken('AuthToken')->plainTextToken;
            $user->otp= null ;
            $user->save();
            return response()->json(['message' => 'Login successful', 'student' => $user, 'token' => $token]);
        } else {
            return response()->json(['message' => 'Invalid OTP'], 400);
        }
    }

}
