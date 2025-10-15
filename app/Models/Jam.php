<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jam extends Model
{
    protected $table = 'jam_operasional';

    protected $fillable = [
        'hari',
        'jam_buka',
        'jam_tutup',
        'status'
    ];
}
