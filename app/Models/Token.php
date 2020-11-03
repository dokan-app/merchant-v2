<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;

    /**
     * Token model fillable properties
     * @var string[]
     */
    protected $fillable = [
        'access_token',
        'refresh_token',
        'expires_in'
    ];

    public function hasExpired()
    {
        return now()->gte($this->updated_at->addSeconds($this->expires_in));
    }
}
