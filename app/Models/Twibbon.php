<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Twibbon extends Model
{
    protected $fillable = [
        'nama',
        'slug',
        'file',
        'keterangan',
        'is_active',
        'hit',
        'download_hit',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
