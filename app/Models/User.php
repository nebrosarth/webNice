<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
    ];
    public function characters()
    {
        return $this->hasMany(Character::class)->withTrashed();
    }
    public function items()
    {
        return $this->hasMany(Item::class);
    }
    public function friends()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id');
    }

    public function addFriend(User $user)
    {
        if (!$this->friends()->find($user->id))
            $this->friends()->attach($user->id);
        if (!$user->friends()->find($this->id))
            $user->friends()->attach($this);
    }

    public function removeFriend(User $user)
    {
        $this->friends()->detach($user->id);
    }

    public function friendsWith(User $user)
    {
        return !is_null($this->friends()->find($user));
    }

}
