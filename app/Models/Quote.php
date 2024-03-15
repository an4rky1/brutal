<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $fillable = [
        'text',
        'author',
        'category',
        'bg_color',
        'text_color',
    ];
}
