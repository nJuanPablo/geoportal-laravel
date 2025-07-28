<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function show()
    {
        if (Auth::check()) {
            // If the user is already authenticated, redirect to home
            return redirect('/geovisor')->with('info', 'You are already logged in.');
        }
        return view('auth.register');
    }

    public function register(RegisterRequest $request){
        $user = User::create($request->validated());
        // Automatically log in the user after registration
        return redirect('/login')->with('success', 'Registration successful!');
    }
}
