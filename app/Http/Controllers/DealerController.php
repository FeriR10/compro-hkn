<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cekout;
use Illuminate\Support\Facades\Session;
use Auth;


class DealerController extends Controller
{
    public function order()
    {
        $cekorders = Cekout::get();
        return view('dealer.order',[
            'cekorders' => $cekorders
        ]);
    }
   
    public function aprove($id)
    {

        // update data 
        $cekorder = Cekout::find($id);
        $cekorder->status = "Selesai";
        $cekorder->update();
        Session::flash('status', 'success');
        Session::flash('message', 'Status Menjadi Selesai');
        return redirect('/order');
    
    }
}
