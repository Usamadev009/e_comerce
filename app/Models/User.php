<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'lname',
        'email',
        'password',
        'mobile',
        'address',
        'role',
        'status',
        'city',
        'state',
        'pincode',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function isUserOnline()
    // {
    //     return Cache::has('user-is-online' . $this->id);
    // }

    public function isUserOnline()
    {
        return Cache::has('user-is-online' . $this->id);
    }

    public function brand()
    {
        return $this->hasMany(Brand::class,'vendor_id');
    }

    public function category()
    {
        return $this->hasMany(Category::class,'vendor_id');
    }

}
