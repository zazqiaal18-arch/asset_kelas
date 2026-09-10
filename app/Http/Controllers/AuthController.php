<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Rapikan email
        $email = strtolower(trim($request->email));

        // Cari user berdasarkan email
        $user = User::where('email', $email)->first();

        // Cek user dan password
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()
                ->withInput($request->only('email'))
                ->with('error', 'Email atau password salah!');
        }

        // Pastikan role valid
        if (!in_array($user->role, ['admin', 'user'])) {
            return back()
                ->withInput($request->only('email'))
                ->with('error', 'Role akun tidak valid. Hubungi administrator.');
        }

        // Login user yang benar
        Auth::login($user);

        // Regenerate session
        $request->session()->regenerate();

        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                $user->role === 'admin'
                    ? 'Berhasil login sebagai Admin!'
                    : 'Berhasil login!'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | REGISTER
    |--------------------------------------------------------------------------
    */

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $email = strtolower(trim($request->email));

        // Guru = Admin
        // Selain guru = User
        $role = str_ends_with($email, '@guru.smk.id')
            ? 'admin'
            : 'user';

        $user = User::create([
            'name' => $request->name,
            'email' => $email,
            'password' => Hash::make($request->password),
            'role' => $role,
        ]);

        // Login akun yang baru dibuat
        Auth::login($user);

        // Regenerate session
        $request->session()->regenerate();

        return redirect()
            ->route('dashboard')
            ->with('success', 'Akun berhasil dibuat!');
    }


    /*
    |--------------------------------------------------------------------------
    | GOOGLE LOGIN
    |--------------------------------------------------------------------------
    */

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {

            $googleUser = Socialite::driver('google')->user();

            $email = strtolower(trim($googleUser->email));

            /*
            |--------------------------------------------------------------------------
            | CARI USER LAMA
            |--------------------------------------------------------------------------
            */

            $user = User::where('google_id', $googleUser->id)
                ->orWhere('email', $email)
                ->first();

            /*
            |--------------------------------------------------------------------------
            | USER BARU
            |--------------------------------------------------------------------------
            */

            if (!$user) {

                $role = str_ends_with($email, '@guru.smk.id')
                    ? 'admin'
                    : 'user';

                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $email,
                    'google_id' => $googleUser->id,
                    'role' => $role,
                ]);

            } else {

                /*
                |--------------------------------------------------------------------------
                | USER LAMA
                |--------------------------------------------------------------------------
                |
                | Role TIDAK diubah.
                | Role tetap mengikuti database.
                |
                */

                if (!$user->google_id) {

                    $user->update([
                        'google_id' => $googleUser->id,
                    ]);
                }
            }

            /*
            |--------------------------------------------------------------------------
            | LOGIN USER
            |--------------------------------------------------------------------------
            */

            Auth::login($user);

            request()->session()->regenerate();

            return redirect()
                ->route('dashboard')
                ->with('success', 'Berhasil login dengan Google!');

        } catch (\Exception $e) {

            return redirect()
                ->route('login')
                ->with(
                    'error',
                    'Gagal login via Google. Silakan coba lagi.'
                );
        }
    }


    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Berhasil keluar!');
    }
}