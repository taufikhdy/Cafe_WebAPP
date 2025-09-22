<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
    protected $table = 'menu';
    protected $fillable = [
        'nama_menu',
        'deskripsi',
        'harga',
        'stok',
        'foto',
        'kategori_id'
    ];

    public function kategori()
    {
        return $this->belongsTo(kategori::class);
    }
}
