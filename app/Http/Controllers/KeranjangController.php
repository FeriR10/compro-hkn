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
use App\Models\Jenispayment;
use App\Models\Payment;



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
        $user = Auth::user();
        
        $keranjang = Keranjang::where('users_id', $user->id)->get();

        // get barang foreach keranjang
        $barangs = [];
        foreach ($keranjang as $key => $value) {
            $barangs[$key] = $value->barang;
        }

        $totalHarga = $keranjang->sum('total_harga');
        $diskon = Diskon::all();
        $jenis_payment = Jenispayment::all();
        
        return view('suplier.keranjang',[
            'keranjang' => $keranjang,
            'barangs' => $barangs,
            'cekouts' => $keranjang,
            'diskon' => $diskon,
            'totalHarga' => $totalHarga,
            'jenis_payment' => $jenis_payment
           
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
    public function destroy($id)
    {
        $keranjang = Keranjang::find($id);
        $keranjang->delete();
        return redirect('/keranjang');
    }
    public function cekoutstore(Request $request)
    {
        $keranjang = Keranjang::where('users_id', Auth::user()->id)->get();

        $diskon_id = $request->diskon;
        $total_harga = $keranjang->sum('total_harga');
        $potongan_harga = 0;
        if (!empty($diskon_id)) {
        $diskon = Diskon::find($diskon_id);
        if ($diskon) {
            // Misalnya diskon diterapkan dalam bentuk persentase
            $potongan_harga = $total_harga * ($diskon->diskon / 100);
            }
        }
        $total_harga_setelah_diskon = $total_harga - $potongan_harga;

        // add new to cekout table
        $payment = new Payment();
        $payment->status = "Belum Di Transfer";
        $payment->jenis_payment_id = $request->jenis_payment_id;
        $payment->users_id = auth()->user()->id;
        $payment->save();

        $cekout = new Cekout();
        $cekout->users_id = auth()->user()->id;
        $cekout->diskon_id = $request->diskon;
        $cekout->total_harga = $total_harga_setelah_diskon;
        $cekout->status = 'Menunggu';
        $cekout->keterangan = $request->keterangan;
        $cekout->payment_id = $payment->id;
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
        
        return redirect('/historypemesanan');
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
        //penamabahan qty pada tabel barang saat update status
        foreach ($cekorder->riwayat as $key => $value) {
            $barang = Barang::find($value->barang_id);
            $barang->qty = $barang->qty + $value->qty;
            $barang->update();
        }
        Session::flash('status', 'success');
        Session::flash('message', 'Pesanan di Batalkan');
        return redirect('/historypemesanan');
    }
    
}
