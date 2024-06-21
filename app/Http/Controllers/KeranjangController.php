<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaksi;
use App\Models\Diskon;
use App\Models\Cekout_aprove;
use App\Models\Cekout;
use App\Models\Riwayat;
use Illuminate\Support\Facades\Session;



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
        $keranjang = Keranjang::where('users_id', Auth::user()->id)->get();
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
            $keranjang->harga_satuan = $barang->harga;
            $keranjang->total_harga = $keranjang->qty * $keranjang->harga_satuan;
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
        
        $keranjang = Keranjang::where('users_id', Auth::user()->id)->get();

        // add new to cekout table
        $cekout = new Cekout();
        $cekout->users_id = auth()->user()->id;
        $cekout->total_harga = $keranjang->sum('total_harga');
        $cekout->status = 'Menunggu';
        $cekout->save();
        
        // foreach save to riwayat table
        foreach ($keranjang as $key => $value) {
            $transaksi = new Riwayat();
            $transaksi->users_id = auth()->user()->id;
            $transaksi->barang_id = $value->barang_id;
            $transaksi->qty = $value->qty;
            $transaksi->harga_satuan = $value->barang->harga;
            $transaksi->total_harga = $value->total_harga;
            $transaksi->cekout_id = $cekout->id;
            $transaksi->save();
            $keranjang = Keranjang::find($value->id);
            $keranjang->delete();

            //pengurangan stok
            $barang = Barang::find($value->barang_id);
            $barang->qty = $barang->qty - $value->qty;
            $barang->update();
        }

        return redirect('/historyorder');
    }
    public function historyorder()
    {
        // $cekorders = Cekout::get()->riwayat()->where('users_id', Auth::user()->id)->get();

        // $cekorders = Cekout get where riwayat users_id = Auth::user()->id
        $cekorders = Cekout::where('users_id', Auth::user()->id)->get();


        return view('suplier.historyorder',[
            'cekorders' => $cekorders
        ]);
    }
    
    //update status historyorderupdate
    public function historyorderupdate($id)
    {
        $cekorder = Cekout::find($id);
        $cekorder->status = "Dibatalkan";
        $cekorder->update();
        Session::flash('status', 'success');
        Session::flash('message', 'Pesanan di Batalkan');
        return redirect('/historyorder');
    }
    
}
