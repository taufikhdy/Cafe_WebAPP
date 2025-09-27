<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    //
    protected $table = ['keranjang'];

    protected $fillable = [
        'meja_id',
        'status'
    ];

    public function meja()
    {
        return $this->belongsTo(Meja::class);
    }

    public function item()
    {
        return $this->hasMany(KeranjangItem::class);
    }
}
