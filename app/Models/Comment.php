<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = []; 

    protected $casts = [
        'created_at' => 'datetime:d.m.y h:i',
    ];

    public function user () {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function image () {
        return $this->belongsTo(User::class, 'image_id', 'id');
    }
}
