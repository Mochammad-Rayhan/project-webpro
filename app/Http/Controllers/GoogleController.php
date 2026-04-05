<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        // Cek apakah user sudah ada
        $user = User::where('google_id', $googleUser->id)->first();

        if (!$user) {
            // cek email
            $user = User::where('email', $googleUser->email)->first();

            if ($user) {
                // update google_id jika email sudah ada
                $user->update([
                    'google_id' => $googleUser->id
                ]);
            } else {
                // buat user baru
                $user = User::create([
                    'nama' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => bcrypt('12345678'), // default password
                    'role' => '0',
                    'status' => 1,
                    'hp' => '-' // FIX
                ]);
            }
        }

        Auth::login($user);
        return redirect()->route('home');
    }
}
