<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pengumuman;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class PengumumanController extends Controller
{
    public function pengumuman()
    {
        $pengumumans = pengumuman::get();
        return view('suplier.pengumuman', compact('pengumumans'));
    }
    //creat pengumuman
    public function createpengumumanProcess(Request $request)
    { 
        $request->validate([
            
            'title' => 'required',
        ]);
        $pengumuman = new pengumuman();
        if($request->hasfile('thumbnail')) {
            $file = $request->file('thumbnail');
            $path = Storage::disk('public')->put('images/pengumuman', $file);
            $pengumuman->thumbnail = $path;
            
        }
        $pengumuman->title = $request->title;
        $pengumuman->save();
        Session::flash('status', 'success');
        Session::flash('message', 'Tambah Barang sukses');
        return redirect('/pengumuman');
    }

    public function deletepengumuman($id)
    {
        $pengumuman = pengumuman::find($id);
        Storage::delete('images/pengumuman' . $pengumuman->thumbnail);
        $pengumuman->delete();
        return redirect('/pengumuman');
    }
}
