<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Note extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'color',
        'is_pinned',
    ];

    protected $casts = [
        'is_pinned' => 'boolean',
    ];

    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        return $query->when($term, fn ($q) => $q->where('title', 'like', '%' . $term . '%'));
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderByDesc('is_pinned')->orderByDesc('created_at');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
