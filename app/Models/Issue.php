<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'title', 'html_url'];

    public function sprint()
    {
        return $this->belongsTo(Sprint::class);
    }
}
