<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Github extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'token',
        'refresh_token',
        'expires_in',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
