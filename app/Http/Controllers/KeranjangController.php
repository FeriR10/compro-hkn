<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaksi;
use App\Models\Diskon;


class KeranjangController extends Controller
{
    public function cekout()
    {
        return view('suplier.cekout');
    }
    public function diskon()
    {
        $diskon = Diskon::get();
        return view('suplier.keranjang',[
            'diskon' => $diskon
        ]);
    }
    public function keranjang()
    {
        $keranjang = Keranjang::get();
        $diskon = Diskon::all();
        
        return view('suplier.keranjang',[
            'keranjang' => $keranjang,
            'cekouts' => $keranjang,
            'diskon' => $diskon,
           
        ]);
    }
    
    public function store(Request $request)
    {
        foreach ($request->keranjang as $key => $value) {
            $barang = Barang::find($key);
            $keranjang = new Keranjang();
            $keranjang->barang_id = $key;
            $keranjang->users_id = auth()->user()->id;
            $keranjang->qty = 1;
            $keranjang->total_harga = $barang->harga;
            $keranjang->save(); 
        }
        return redirect('/keranjang');
    }
    public function kurang($id)
    {
        $keranjang = Keranjang::find($id);

        if ($keranjang->qty == 1) {
            $keranjang->delete();
            return redirect('/keranjang');
        } else {
            $keranjang->qty = $keranjang->qty - 1;
            $keranjang->total_harga = $keranjang->total_harga - $keranjang->barang->harga;
            $keranjang->save();
            return redirect('/keranjang');
        }

    }

    public function tambah($id)
    {
        $keranjang = Keranjang::find($id);
        $keranjang->qty = $keranjang->qty + 1;
        $keranjang->total_harga = $keranjang->total_harga + $keranjang->barang->harga;
        $keranjang->save();
        return redirect('/keranjang');
    }
    public function cekoutstore(Request $request)
    {
        foreach ($request->cekouts as $key => $value) {
            $barang = keranjang::find($key);
            $cekouts = new Transaksi();
            $cekouts->barang_id = keranjang::find($key)->barang_id;
            $cekouts->users_id = auth()->user()->id;
            $cekouts->qty = keranjang::find($key)->qty;
            $cekouts->total_harga_cekout = keranjang::find($key)->total_harga;
            $cekouts->save(); 
        }
        return redirect('/keranjang');
    }
}
