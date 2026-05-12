<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        return view('backend.v_login.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'hp' => 'required|min:10|max:13',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'hp' => $request->hp,
            'email' => $request->email,
            'password' => Hash::make($request->password),

            // DEFAULT
            'status' => 1,
            'role' => '1',

            // FOTO DEFAULT
            'foto' => 'https://i.pinimg.com/736x/3c/67/75/3c67757cef723535a7484a6c7bfbfc43.jpg' ]);

        // LOGIN OTOMATIS
        Auth::login($user);

        // KE HOME
        return redirect()->route('home');
    }
}