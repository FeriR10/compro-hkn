<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'kategori_id', 'id');
    }
}
