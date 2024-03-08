<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_user',
        'second_user',
        'acted_user',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'first_user');
    }

    public function friend_requests()
    {
        return $this->hasMany(Friendship::class, 'second_user')->where('status', 'pending');
    }

    public function friendships()
    {
        return $this->hasMany(Friendship::class, 'first_user')->where('status', 'confirmed');
    }

    public function getFriendsAttribute()
    {
        return $this->friendships()->pluck('second_user');
    }

    // // accessor for blocked friends
    // public function getBlockedFriendsAttribute()
    // {
    //     return $this->hasMany(Friendship::class, 'first_user')
    //                 ->where('status', 'blocked')
    //                 ->where('acted_user', $this->id)
    //                 ->pluck('second_user');
    // }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($friendship) {
            // Update friendships for both users when a new friendship is created
            Friendship::where('first_user', $friendship->second_user)
                ->where('second_user', $friendship->first_user)
                ->update(['status' => 'confirmed']);
        });
    }
}
