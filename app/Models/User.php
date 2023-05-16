<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'description',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function boards () {
        return $this->hasMany(Board::class);
    }

    public function images () {
        return $this->hasMany(Image::class);
    }

    public function comments () {
        return $this->hasMany(Comment::class);
    }  

    public function likedImages () {
        return $this->belongsToMany(Image::class, 'image_user_likes', 'user_id', 'image_id' );
    }

    public function subscriptions () {
        return $this->belongsToMany(User::class, 'user_subscription', 'user_id', 'subscription_id' );
    }

    public function subscribers () {
        return $this->belongsToMany(User::class, 'user_subscription', 'subscription_id', 'user_id' );
    }
}
