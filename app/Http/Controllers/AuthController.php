<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    // 1. Tampilkan Form Login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // 2. Proses Login Manual
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            // ✅ Ubah ke dashboard
            return redirect()->intended(route('dashboard'))->with('success', 'Berhasil Login!');
        }

        return back()->with('error', 'Email atau password salah!');
    }

    // 3. Tampilkan Form Register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // 4. Proses Register Manual
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'admin',
        ]);

        Auth::login($user);

        // ✅ Ubah ke dashboard
        return redirect()->route('dashboard')->with('success', 'Akun berhasil dibuat!');
    }

    // 5. Redirect ke Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // 6. Callback Google
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('google_id', $googleUser->id)
                        ->orWhere('email', $googleUser->email)
                        ->first();

            if (!$user) {
                $user = User::create([
                    'name'      => $googleUser->name,
                    'email'     => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'role'      => 'admin',
                ]);
            } else {
                if (!$user->google_id) {
                    $user->update(['google_id' => $googleUser->id]);
                }
            }

            Auth::login($user);

            // ✅ Ubah ke dashboard
            return redirect()->route('dashboard')->with('success', 'Berhasil login dengan Google!');

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Gagal login via Google. Silakan coba lagi.');
        }
    }

    // 7. Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Berhasil keluar!');
    }
}
