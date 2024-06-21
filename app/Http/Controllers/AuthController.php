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
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role == "karyawan") {

                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                Session::flash('status', 'failed');
                Session::flash('message', 'Akun anda belum disetujui admin, hubungi admin untuk konfirmasi akun anda!');
                return redirect('/login');
            }
 
            return redirect()->intended('/barangjual');
        }

        Session::flash('status', 'failed');
        Session::flash('message', 'Login Wrong!');

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
