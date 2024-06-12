<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'id');
    }
    public function diskon()
    {
        return $this->belongsTo(Diskon::class, 'diskon_id', 'id');
    }
}
