<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cekout;
use Illuminate\Support\Facades\Session;
use Auth;
use App\Models\Payment;
use App\Models\Riwayat;
use App\Models\Profileuser;
use App\Models\Pengumuman;



class DealerController extends Controller
{
    public function order()
    {
        $cekorders = Cekout::orderBy('created_at', 'desc')->get();
        return view('dealer.order',[
            'cekorders' => $cekorders
        ]);
    }
    public function aprovepayment($id)
    {

        // update data 
        $pay = Cekout::find($id);
        $aprove = Payment::find($pay->payment_id);
        $aprove->status = "Berhasil Bayar";
        $aprove->update();
      
        Session::flash('status', 'success');
        Session::flash('message', 'Status Menjadi Berhasil Bayar');
        return redirect('/order');
    
    }
   
    public function aprove($id)
    {

        // update data 
        $cekorder = Cekout::find($id);
        $cekorder->status = "Menunggu";
        $cekorder->update();
        Session::flash('status', 'success');
        Session::flash('message', 'Status Menjadi Menunggu');
        return redirect('/order');
    
    }
    public function dp_lunas($id)
    {

        // update data 
        $cekorder = Cekout::find($id);
        $cekorder->status = "DP lunas";
        $cekorder->update();
        Session::flash('status', 'success');
        Session::flash('message', 'Status Menjadi DP lunas');
        return redirect('/order');
    
    }
    public function lunas($id)
    {

        // update data 
        $cekorder = Cekout::find($id);
        $cekorder->status = "Lunas";
        $cekorder->update();
        Session::flash('status', 'success');
        Session::flash('message', 'Status Menjadi Lunas');
        return redirect('/order');
    
    }
    public function dibatalkan($id)
    {

        // update data 
        $cekorder = Cekout::find($id);
        $cekorder->status = "Dibatalkan";
        $cekorder->update();
        Session::flash('status', 'success');
        Session::flash('message', 'Status Menjadi Dibatalkan');
        return redirect('/order');
    
    }
    public function historypemesanan()
    {
        // $cekorders = Cekout::get()->riwayat()->where('users_id', Auth::user()->id)->get();

        // $cekorders = Cekout get where riwayat users_id = Auth::user()->id
        // $cekorders = Cekout::where('users_id', Auth::user()->id)->get();
        $cekorders = Cekout::where('users_id', auth()->user()->id)->get();
        // dd($cekorders);
        return view('dealer.historypemesanan', compact('cekorders'));
    }
    
    //update status historyorderupdate
    public function historypemesananupdate($id)
    {
        $cekorder = Cekout::find($id);
        $cekorder->status = "Dibatalkan";
        $cekorder->update();
        
        Session::flash('status', 'success');
        Session::flash('message', 'Pesanan di Batalkan');
        return redirect('/historypemesanan');
    }
    public function viewdetailorder(Request $request, $id)
    {
        $cekorder = Cekout::where('id', $id)->first();
        $optionRiwayats = Riwayat::where('cekout_id', $id)->get(); 

        $riwayat = Riwayat::where('cekout_id', $id);

        if ($request->cari) {
            $riwayat = $riwayat->where('id', $request->cari);
        }

        $riwayat = $riwayat->get();

        if (is_null($cekorder)) {
            return redirect()->back()->with('error', 'Order not found');
        }
        $totalharga = Riwayat::where('cekout_id', $id)->sum('total_harga');
        //pengambilan bukti_bayar pada table payment
        $bukti = Payment::where('id', $cekorder->payment_id)->value('bukti_bayar');
        $alamat = Profileuser::where('users_id',  $cekorder->users_id)->first();
        


        return view('dealer.viewdetailorder',[
            'cekorder' => $cekorder,
            'optionRiwayats' => $optionRiwayats,
            'riwayat' => $riwayat,
            'totalharga' => $totalharga,
            'bukti' => $bukti,
            'alamat' => $alamat
        ]);

    }
    public  function homepage()
    {
        $pengumuman = Pengumuman::get();
        $home = Cekout::where('users_id', auth()->user()->id)->get();
        return view('dealer.homepage', compact('home', 'pengumuman'));
    }
    
}
