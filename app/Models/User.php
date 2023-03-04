<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

     protected function Name(): Attribute
     {
         return new Attribute(
             get: fn ($value) => $value,
             set: fn ($value) => strtoupper($value),
         );
     }

     protected function Email(): Attribute
     {
         return new Attribute(
             fn ($value) => $value,
             fn ($value) => strtolower($value),
         );
     }

     protected function password(): Attribute
     {
         return new Attribute(
           get: fn ($value) => bcrypt($value),
            set:fn ($value) => bcrypt($value),
         );
     }
}
