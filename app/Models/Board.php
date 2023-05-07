<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;
    protected $guarded = []; 
    public function images () {
        return $this->belongsToMany(Image::class, 'board_images','board_id','image_id');
    }

    public function user () {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


}
