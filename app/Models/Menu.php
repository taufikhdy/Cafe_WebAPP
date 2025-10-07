<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

// class Menu extends Model

class Menu extends Authenticatable
{
    //
    protected $table = 'menu';
    protected $fillable = [
        'nama_menu',
        'deskripsi',
        'harga',
        'status_stok',
        'penjualan',
        'foto',
        'kategori_id'
    ];

    public function kategori()
    {
        return $this->belongsTo(kategori::class);
    }

    // public function meja() : HasMany
    // {
    //     return $this->hasMany(Meja::class);
    // }

    public function keranjangItems()
    {
        return $this->hasMany(KeranjangItem::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
