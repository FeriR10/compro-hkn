<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cekout extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'cekout';

    public function riwayat()
    {
        return $this->hasMany(Riwayat::class, 'cekout_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
