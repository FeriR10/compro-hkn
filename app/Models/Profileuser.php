<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profileuser extends Model
{
    use HasFactory;
    protected $table = 'profileuser';

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
