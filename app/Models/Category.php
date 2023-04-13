<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Category extends Model
{
    use HasFactory, Notifiable;

    public $timpestamps = false;

    public function cuti()
    {
        return $this->hasMany(Cuti::class);
    }
}
