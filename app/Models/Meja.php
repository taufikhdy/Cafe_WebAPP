<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    //
    protected $table = 'meja';

    protected $fillable = [
        'nama_meja',
        'username',
        'status',
        'role_id',
        'password'
    ];

    protected $hidden = [
        'password',
    ];

    public function role()
    {
        return $this->belongsTo(Roles::class);
    }

    // public function menu()
    // {
    //     return $this->belongsTo(Menu::class);
    // }


    public function keranjang()
    {
        return $this->hasOne(Keranjang::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
