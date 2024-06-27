<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cekout;
use Illuminate\Support\Facades\Session;
use Auth;
use App\Models\Payment;



class DealerController extends Controller
{
    public function order()
    {
        $cekorders = Cekout::get();
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
        $cekorder->status = "Aprove";
        $cekorder->update();
        Session::flash('status', 'success');
        Session::flash('message', 'Status Menjadi Selesai');
        return redirect('/order');
    
    }
    public function historypemesanan()
    {
        // $cekorders = Cekout::get()->riwayat()->where('users_id', Auth::user()->id)->get();

        // $cekorders = Cekout get where riwayat users_id = Auth::user()->id
        $cekorders = Cekout::where('users_id', Auth::user()->id)->get();


        return view('dealer.historypemesanan',[
            'cekorders' => $cekorders
        ]);
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
    public function viewdetailorder($id)
    {
        $cekorder = Cekout::where('id', $id)->first();
        // $barang = Barang::find($cekorder->barang_id);
        // $diskon = Diskon::find($cekorder->diskon_id);
        if (is_null($cekorder)) {
            return redirect()->back()->with('error', 'Order not found');
        }
        
        return view('dealer.viewdetailorder',[
            'cekorder' => $cekorder
        ]);

    }
}
