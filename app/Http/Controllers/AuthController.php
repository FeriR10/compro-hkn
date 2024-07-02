<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function register()
    {
        return view('auth.register');
    }

    public function loginProcess(Request $request)
{
    // Validasi input login
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    // Percobaan otentikasi
    if (Auth::attempt($credentials)) {
        // Regenerasi sesi
        $request->session()->regenerate();

        // Cek role pengguna
        if (Auth::user()->role->role === 'dealer') {
            // Redirect ke halaman /homepage jika role adalah dealer
            return redirect('/homepage');
        }
        elseif (Auth::user()->role->role === 'admin') {
            // Redirect ke halaman /admin jika role adalah admin
            return redirect('/dashboard');
        }
        // Redirect ke halaman yang diinginkan jika role bukan dealer
        return redirect()->intended('/dashboard');
    }

    // Flash pesan jika login gagal
    Session::flash('status', 'failed');
    Session::flash('message', 'Login Wrong!');

    // Redirect ke halaman login jika otentikasi gagal
    return redirect('/login');
}


    public function registerProcess(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'role_id' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;
        $user->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Register sukses, hubungi admin untuk konfirmasi akun anda');
        return redirect('/register');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
