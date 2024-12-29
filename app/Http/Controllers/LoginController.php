<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;


class LoginController extends Controller
{
    public function aksi_login(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ],[
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password harus diisi.',
        ]);

        if (Auth::attempt($credentials)) {
            if (Auth::user()->level_user == "admin") {
                $request->session()->regenerate();
                return ['code' => '200', 'status' => 'success', 'message' => 'Berhasil Login', 'redirect' => url('/')];
            } else {
                return ['code' => '201', 'status' => 'error', 'message' => 'Error: Anda tidak memiliki akses'];
            }
        }
        else {
            return ['code' => '401', 'status' => 'error', 'message' => 'Error: Invalid credentials'];
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout()  {
        Auth::logout();
        return redirect('/login');
    }

    public function login() {
        return view('login.login');
    }

}
