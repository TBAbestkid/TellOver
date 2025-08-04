<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'notifications_email',
        'profile_visibility',
        'tabs',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'notifications_email' => 'boolean',
        'profile_visibility' => 'string',
    ];

    /**
     * Automatically hash password when set.
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['password'] = Hash::make($value);
        }
    }

    /**
     * Define a many-to-many relationship with the User model for friends.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function friends()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id');
    }

    public function personagens()
    {
        return $this->hasMany(Personagem::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // Quem eu estou seguindo (eu sou o follower)
    public function following()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }

    // Quem me segue (outros users são followers, eu sou user_id)
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // public function notifications()
    // {
    //     return $this->hasMany(Notification::class);
    // }

}
