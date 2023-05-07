<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $guarded = []; 
    
    public function boards () {
        return $this->belongsToMany(Board::class, 'board_images','image_id','board_id');

    }   

    public function user () {
        return $this->belongsTo(Board::class, 'user_id', 'id');
    }   

    public function comments () {
        return $this->hasMany(Comment::class);
    }   

    public function likedUsers () {
        return $this->belongsToMany(User::class, 'image_user_likes', 'image_id', 'user_id' );
    }
}
