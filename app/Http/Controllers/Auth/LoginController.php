<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.loginpage');
    }

    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt to log in the user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            if ($user->role === 'admin') {
                return response()->json(['success' => true, 'redirect' => route('admin.dashboard')]);
            } elseif ($user->role === 'personnel') {
                return response()->json(['success' => true, 'redirect' => route('personnel.dashboard')]);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid credentials',
            'alert_type' => 'danger'
        ], 401);
    }

    public function redirectToGoogle()
    {
        $redirectUrl = Socialite::driver('google')->redirect()->getTargetUrl();
        Log::info('Generated Google OAuth Redirect URL: ' . $redirectUrl);

        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            Log::info(request()->fullUrl());
            $googleUser = Socialite::driver('google')->user();

            // Find or create the user
            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'google_id' => $googleUser->getId(),
                    'password' => bcrypt('random_generated_password'),
                ]
            );

            // Log the user in
            Auth::login($user);

            // Redirect based on the role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'personnel') {
                return redirect()->route('personnel.dashboard');
            }

            return redirect()->route('home');
        } catch (\Exception $e) {
            return redirect()->route('auth.google')->withErrors('Login failed');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.page');
    }
}
