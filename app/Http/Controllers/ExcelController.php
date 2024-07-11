<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\HistoryExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Models\Cekout;
use App\Models\Payment;
use App\Models\Riwayat;
use App\Models\Profileuser;
use App\Models\Pengumuman;
use App\Models\User;


class ExcelController extends Controller
{
    public function export(Request $request, $id)
    {
        return Excel::download(new HistoryExport($id), 'history-' . Carbon::now()->timestamp . '.xlsx');
    }



    
    public function historybyorder()
    {
        $riwayat = Riwayat::all();
        $cekout = Cekout::all();
        return view('excel.historybyorder',[
            'riwayat' => $riwayat,  
            'cekout' => $cekout
        ]);
    }
}
