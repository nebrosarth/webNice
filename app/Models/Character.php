<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Character extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'description',
        'name2',
        'description2',
        'image_url',
        'date1'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function items()
    {
        return $this->hasMany(Item::class);
    }
    protected static function booted()
    {
        static::creating(function ($character)
        {
            if(!Auth::check())
                abort(401,"Authentication required");
            $character->user_id = Auth::id();
        });
        static::updating(function($character)
        {
            if(!Auth::check())
                abort(401, "Authentication required");
            if(Auth::id() != $character->user_id && !Auth::user()->is_admin)
                abort(403, "Unauthorized");
        });
        static::deleting(function($character)
        {
            if(!Auth::check())
                abort(401, "Authentication required");
            if(Auth::id() != $character->user_id && !Auth::user()->is_admin)
                abort(403, "Unauthorized");
        });
    }
}
