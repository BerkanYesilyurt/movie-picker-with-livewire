<?php

namespace App\Models;

use App\Enums\ContentTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Suggestion extends Model
{
    protected $table = 'suggestions';
    protected $fillable = [
        'user_id',
        'type',
        'content'
    ];
    protected $casts = [
        'type' => ContentTypeEnum::class,
        'content' => 'json'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function favorite(): HasOne
    {
        return $this->hasOne(UserFavorite::class, 'suggestion_id', 'id');
    }
}
