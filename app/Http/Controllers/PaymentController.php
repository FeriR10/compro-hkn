<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jenispayment;
use Illuminate\Support\Facades\Session;
use App\Models\Payment;
use Illuminate\Support\Facades\Storage;



class PaymentController extends Controller
{
    public function jenispayment()
    {
        $payments = Jenispayment::get();
        return view('suplier.jenis_payment',[
            'payments' => $payments
        ]);
    }
    //creaet payment
    public function store(Request $request)
    {
        $payment = new Jenispayment();
        $payment->jenis_payment = $request->jenis_payment;
        $payment->status = "aktiv";
        $payment->save();
        Session::flash('status', 'success');
        Session::flash('message', 'Payment Berhasil');
        return redirect('/jenispayment');
    }
    public function paymentaktiv($id)
    {
        $payment = Jenispayment::find($id);
        $payment->status = "aktiv";
        $payment->update();
        Session::flash('status', 'success');
        Session::flash('message', 'Status Menjadi Aktiv');
        return redirect('/jenispayment');
    }
    public function paymentnonaktiv($id)
    {
        $payment = Jenispayment::find($id);
        $payment->status = "non-aktiv";
        $payment->update();
        Session::flash('status', 'success');
        Session::flash('message', 'Status Menjadi Non-Aktiv');
        return redirect('/jenispayment');
    }
    public function uploadbuktibayar($id)
    {
        $upload = Payment::find($id);
        return view('dealer.uploadbuktitransfer',[
            'upload' => $upload,
            
        ]);
    }
    public function createuploadbuktibayar(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'bukti_bayar' => 'required|file',
        ]);
    
        // Cari data berdasarkan $id
        $upload = Payment::find($id);
    
        // Periksa apakah data ditemukan
        if (!$upload) {
            return redirect()->back()->withErrors(['message' => 'Data tidak ditemukan.']);
        }
    
        // Periksa apakah file 'bukti_bayar' ada dalam permintaan
        if ($request->hasFile('bukti_bayar')) {
            // Jika ada file sebelumnya, hapus dari storage
            if ($upload->bukti_bayar) {
                Storage::disk('public')->delete($upload->bukti_bayar);
            }
    
            // Simpan file baru dan update path di database
            $file = $request->file('bukti_bayar');
            $path = Storage::disk('public')->put('images/buktibayar', $file);
            $upload->bukti_bayar = $path;
        }
    
        // Update data di database
        if ($upload->save()) { // Gunakan save() untuk menyimpan perubahan
            // Set flash message dan redirect
            Session::flash('status', 'success');
            Session::flash('message', 'Edit kontak sukses');
            return redirect('/historypemesanan');
        } else {
            // Jika update gagal
            return redirect()->back()->withErrors(['message' => 'Gagal mengupdate data.']);
        }
    }
    
}
