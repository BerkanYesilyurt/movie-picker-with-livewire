<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Watchlist extends Model
{
    protected $table = 'watchlist';
    protected $fillable = [
        'user_id',
        'list'
    ];
    protected $casts = [
        'list' => 'json'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
