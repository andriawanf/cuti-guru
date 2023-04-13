<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Cuti extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'cuti';

    protected $fillable = [
        'alasan',
        'from',
        'to',
        'file',
        'status',
        'durasi_cuti',
        'signature',
        'cat_id',
        'sub_id',
        'user_id',
    ];

    public $timpestamps = false;

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id', 'id', 'title');
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'sub_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function signature()
    {
        return $this->belongsTo(Signature::class, 'sig_id', 'id', 'signature');
    }
}
