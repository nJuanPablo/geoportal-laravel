<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Models\User;


class LoginController extends Controller
{
    public function show()
    {
        if (Auth::check()) {
            // If the user is already authenticated, redirect to home
            return redirect('/geovisor')->with('info', 'You are already logged in.');
        }
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->getCredentials();
        // Attempt to authenticate the user with the provided credentials
        if (!Auth::validate($credentials)) {
            // If validation fails, redirect back with an error message
            return redirect()->to('/login')->withErrors('Invalid credentials. Please try again.');
        }
        // If validation passes, attempt to log in the user
        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        Auth::login($user);
        return $this->authenticated($request, $user);
    }

    public function authenticated(Request $request, $user)
    {
        // Redirect to the intended page or home if no intended page is set
        return redirect('/geovisor')->with('success', 'Login successful!');
    }
}
