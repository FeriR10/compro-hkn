<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;
    protected $table = 'keranjang';

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
