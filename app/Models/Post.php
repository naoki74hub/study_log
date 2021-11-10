<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Post extends Model
{
    protected $fillable = [
    'title',
    'time',
    'body',
    'image_url',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }
}
