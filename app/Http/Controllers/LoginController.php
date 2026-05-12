<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginBackend() 
    {
        return view('backend.v_login.login' , [
            'judul' => 'Halaman Login'
        ]);
    }

    public function authenticateBackend(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            // cek status user
            if ($user->status == 0) {
                Auth::logout();

                return back()->with('error', 'User belum aktif');
            }

            // regenerate session
            $request->session()->regenerate();

            // role admin
            if ($user->role == 1) {
                return redirect()->route('backend.beranda');
            }

            // role user/pengguna
            return redirect()->route('home');
        }

        return back()->with('error', 'Email atau Password salah');
    }


    public function logoutBackend()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        // return redirect(route('backend.login'));
        return redirect()->route('home');
    }
}
