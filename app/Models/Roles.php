<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Roles extends Model
{
    //

    protected $fillable = ['nama_role'];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function meja(): HasMany
    {
        return $this->hasMany(Meja::class);
    }
}
