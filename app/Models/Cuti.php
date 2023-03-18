<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;

    protected $table = 'cuti';

    protected $fillable = [
        'alasan',
        'from',
        'to',
        'file',
        'status',
        'durasi_cuti',
        'cat_id',
        'sub_id',
        'user_id',
    ];

    public $timpestamps = false;

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'sub_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
