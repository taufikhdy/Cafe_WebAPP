<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    //
    protected $table = 'rating';

    protected $fillable = [
        'menu_id',
        'meja_id',
        'username',
        'nilai',
        'ulasan'
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function meja()
    {
        return $this->belongsTo(Meja::class);
    }
}
