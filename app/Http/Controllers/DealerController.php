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
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Models\Barang;



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
    public function cekoutdibatalkan($id)
{
    // Temukan data checkout berdasarkan ID
    $cekorder = Cekout::find($id);

    if (!$cekorder) {
        Session::flash('status', 'error');
        Session::flash('message', 'Data checkout tidak ditemukan');
        return redirect('/historypemesanan');
    }

    // Update status data checkout
    $cekorder->status = "Dibatalkan";

    // Dapatkan data riwayat yang terkait
    $riwayatRecords = $cekorder->riwayat;

    if ($riwayatRecords->isEmpty()) {
        Session::flash('status', 'error');
        Session::flash('message', 'Data riwayat tidak ditemukan');
        return redirect('/historypemesanan');
    }

    foreach ($riwayatRecords as $riwayat) {
        // Temukan data barang yang terkait
        $barang = Barang::find($riwayat->barang_id);

        if ($barang) {
            // Update jumlah barang
            $barang->qty += $riwayat->qty;
            $barang->save();
        } else {
            Session::flash('status', 'error');
            Session::flash('message', 'Data barang tidak ditemukan');
            return redirect('/historypemesanan');
        }
    }

    // Simpan perubahan data checkout
    $cekorder->save();

    // Set pesan flash dan redirect
    Session::flash('status', 'success');
    Session::flash('message', 'Status menjadi dibatalkan');
    return redirect('/historypemesanan');
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
    public function editprofile()
    {
        $profile = User::where('id', auth()->user()->id)->first();
        return view('dealer.editprofile', compact('profile'));
    }

    public function updateprofile(Request $request)
{
    $request->validate([
        'alamat' => 'required',
        'alamat_kirim' => 'required',
        'no_telpon' => 'required',
        'nama_pic' => 'required',
    ]);

    // Get the authenticated user's ID
    $userId = auth()->user()->id;
    
    // Find the profile using the user ID
    $profile = Profileuser::where('users_id', $userId)->first();
    
    // If the profile is not found, create a new one
    if ($profile === null) {
        $profile = new Profileuser();
        $profile->users_id = $userId; // Make sure to set the user ID
    }
    
    // Update the profile fields
    $profile->alamat = $request->alamat;
    $profile->alamat_kirim = $request->alamat_kirim;
    $profile->no_telpon = $request->no_telpon;
    $profile->nama_pic = $request->nama_pic;
    
    // Save the profile (use save() instead of update() for both create and update)
    $profile->save();
    
    // Redirect to the homepage
    return redirect('/homepage');
}

    public function exportpdf($id)
    {
        $export = Cekout::where('id', $id)->first();
        $totalharga = Riwayat::where('cekout_id', $id)->sum('total_harga');
        //pengambilan bukti_bayar pada table payment
        $riwayat = Riwayat::where('cekout_id', $id)->get();
        $bukti = Payment::where('id', $export->payment_id)->value('bukti_bayar');
        $alamat = Profileuser::where('users_id',  $export->users_id)->first();
        $pdf = PDF::loadView('pdf.export-cekout', compact('export', 'totalharga', 'bukti', 'alamat', 'riwayat'));
        return $pdf->download('export-cekout'.Carbon::now()->format('d-m-Y').'.pdf');
    }
}
