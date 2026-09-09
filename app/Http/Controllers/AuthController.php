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


        if (!Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {

            return back()
                ->withInput($request->only('email'))
                ->with('error', 'Email atau password salah!');
        }


        // Regenerate session untuk keamanan
        $request->session()->regenerate();


        /*
        |--------------------------------------------------------------------------
        | REDIRECT BERDASARKAN ROLE
        |--------------------------------------------------------------------------
        */

        if (Auth::user()->role === 'admin') {

            return redirect()
                ->route('dashboard')
                ->with('success', 'Berhasil login sebagai Admin!');

        }


        if (Auth::user()->role === 'user') {

            return redirect()
                ->route('dashboard')
                ->with('success', 'Berhasil login!');

        }


        // Jika role tidak dikenal
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('error', 'Role akun tidak valid. Hubungi administrator.');
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


        /*
        |--------------------------------------------------------------------------
        | SEMUA REGISTRASI BARU = USER
        |--------------------------------------------------------------------------
        |
        | Admin TIDAK dibuat melalui halaman register.
        | Ini lebih aman karena user tidak bisa membuat dirinya sendiri
        | menjadi admin.
        |
        */

        $user = User::create([
            'name' => $request->name,
            'email' => strtolower(trim($request->email)),
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);


        Auth::login($user);

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
            |
            | Google login baru selalu dibuat sebagai USER.
            | Jangan otomatis memberikan role admin dari email.
            |
            */

            if (!$user) {

                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $email,
                    'google_id' => $googleUser->id,
                    'role' => 'user',
                ]);

            } else {

                /*
                |--------------------------------------------------------------------------
                | UPDATE GOOGLE ID JIKA BELUM ADA
                |--------------------------------------------------------------------------
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


            /*
            |--------------------------------------------------------------------------
            | REGENERATE SESSION
            |--------------------------------------------------------------------------
            */

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