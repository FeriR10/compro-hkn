<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaksi;
use App\Models\Diskon;


class BarangController extends Controller
{
    public function barang()
    {
        $barang = Barang::get();
        return view('suplier.barang',[
            'barang' => $barang,
        ]);
    }
    public function tambah()
    {
        return view('suplier.tambah');
    }
    public function create(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kategori_barang' => 'required',
            'kode_barang' => 'required',
            'qty' => 'required',
            'harga' => 'required',
        ]);

        

        $barangs = new Barang();
        $barangs->nama_barang = $request->nama_barang;
        $barangs->kategori_barang = $request->kategori_barang;
        $barangs->kode_barang = $request->kode_barang;
        $barangs->qty = $request->qty;
        $barangs->harga = $request->harga;
        if($request->hasfile('thumbnail')) {
            $file = $request->file('thumbnail');
            $path = Storage::disk('public')->put('images/barang', $file);
            $barangs->thumbnail = $path;
            
        }
        $barangs->save();
        
        Session::flash('status', 'success');
        Session::flash('message', 'Tambah Barang sukses');
        return redirect('/barang');
      
    }

    public function edit($id)
    {
        $barang = Barang::find($id);
        return view('suplier.edit',[
            'barang' => $barang
        ]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kategori_barang' => 'required',
            'kode_barang' => 'required',
            'qty' => 'required',
            'harga' => 'required',
        ]);

        // update data 
        $barang = Barang::find($id);
        $barang->nama_barang = $request->nama_barang;
        $barang->kategori_barang = $request->kategori_barang;
        $barang->kode_barang = $request->kode_barang;
        $barang->qty = $request->qty;
        $barang->harga = $request->harga;
        if($request->hasFile('thumbnail')){
            if($barang->thumbnail){
                Storage::disk('public')->delete($barang->thumbnail);
            }
            $file = $request->file('thumbnail');
            $path = Storage::disk('public')->put('images/barang', $file);
            $barang->thumbnail = $path;
        }
        $barang->update();

        Session::flash('status', 'success');
        Session::flash('message', 'Edit kontak sukses');
        return redirect('/barang');
    }

    public function delete($id)
    {
        $barang = Barang::find($id);
        Storage::delete('images/barang/' . $barang->thumbnail);
        $barang->delete();
        return redirect('/barang');
    }
    public function barangjual()
    {
        $barang = Barang::get();
        return view('suplier.barangjual',[
            'barang' => $barang,
        ]);
    }
    public function index()
    {
        $barangs = Barang::get();
        $keranjangs = Keranjang::where('users_id', Auth::user()->id)->get();
        return view('suplier.barangjual', compact('barangs', 'keranjangs'));
       
    }
    public function viewdiskon()
    {
        $diskon = Diskon::get();
        return view('suplier.diskon',[
            'diskon' => $diskon,
        ]);
    }
    public function creatediskon()
    {
        return view('suplier.creatediskon');
    }
    public function creatediskonProcess(Request $request)
    {
        $request->validate([
            'diskon' => 'required',
        ]);
        $diskon = new Diskon();
        $diskon->diskon = $request->diskon;
        $diskon->persen = $request->diskon / 100;
        $diskon->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Diskon Berhasil Di Tambahkan');
        return redirect('/viewdiskon');
    }
    public function deletediskon($id)
    {
        $diskon = Diskon::find($id);
        $diskon->delete();

        Session::flash('status', 'success');
        Session::flash('message', 'Diskon Berhasil Di HAPUS');
        return redirect('/viewdiskon');
    }

}
