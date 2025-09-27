<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeranjangItem extends Model
{
    //

    protected $table = 'keranjang_item';

    protected $fillable = [
        'keranjang_id',
        'menu_id',
        'jumlah'
    ];

    public function keranjang()
    {
        return $this->belongsTo(Keranjang::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
