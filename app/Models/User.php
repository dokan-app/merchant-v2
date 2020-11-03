<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Http;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * User constructor.
     */
    public function __construct()
    {
//        $this->setU
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id'
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

    /**
     * User token
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function token()
    {
        return $this->hasOne(Token::class);
    }

    public function getMeAttribute()
    {
        return Http::withHeaders([
            'Authorization' => 'Bearer ' . auth()->user()->token->access_token,
        ])->post(env('OAUTH_SERVER_URL') . '/api/auth/me');

    }
}
