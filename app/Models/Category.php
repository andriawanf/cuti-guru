<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timpestamps = false;

    public function cuti()
    {
        return $this->hasMany(Cuti::class);
    }
}
