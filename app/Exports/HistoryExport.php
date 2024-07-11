<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Models\Cekout;

class HistoryExport implements FromView, WithStyles
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function view(): View
    {
        $cekout = Cekout::with(['riwayat', 'riwayat.user', 'riwayat.barang', 'diskon', 'payment.jenis_payment'])->where('id', $this->id)->first();
        $riwayats = $cekout ? $cekout->riwayat : [];

        return view('excel.historybyorder', [
            'riwayat' => $riwayats,
            'cekout' => $cekout
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        $rows = count($sheet->toArray());
        $sheet->getStyle('A1:J' . $rows)->getBorders()->getAllBorders()->setBorderStyle('thin');
    }
}

