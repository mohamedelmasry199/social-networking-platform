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
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'first_user');
    }

    public function getFriendsAttribute()
    {
        return $this->where('status', 'confirmed')
                    ->where(function ($query) {
                        $query->where('first_user', $this->first_user)
                              ->orWhere('second_user', $this->first_user);
                    })
                    ->pluck('first_user', 'second_user');
    }

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
