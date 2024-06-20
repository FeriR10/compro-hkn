<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cekout_aprove extends Model
{
    use HasFactory;
    protected $table = 'cekout_aprove';

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'id');
    }
    
}
