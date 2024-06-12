<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Profileuser;
use App\Models\Keranjang;

class AdminController extends Controller
{
    public function dashboard()
    {
        $barang = Barang::get();
        return view('admin.dashboard',[
            'barang' => $barang,
        ]);
    }
    public function registeradmin()
    {
        return view('admin.registeradmin');
    }
    public function tambahuserProcess(Request $request)
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
        Session::flash('message', 'Akun User baru sukses ditambahkan');
        return redirect('/registeradmin');
    }
    public function datauser()
    {
        $users = User::get();
        $profileuser = Profileuser::get();
        return view('admin.datauser',[
            'profileuser' => $profileuser,
            'users' => $users,
        ]);
    }
}
