<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //

    protected $table = 'order';

    protected $fillable = [
        'meja_id',
        'total_harga',
        'status'
    ];

    public function meja()
    {
        return $this->belongsTo(Meja::class);
    }

    public function item()
    {
        return $this->hasMany(OrderItem::class);
    }
}
