<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CollectionRating extends Model
{
    protected $fillable = [
        'collection_id',
        'user_id',
        'visitor_ip',
        'visitor_session',
        'rating',
        'comment',
        'is_approved'
    ];

    protected $casts = [
        'rating' => 'decimal:1',
        'is_approved' => 'boolean'
    ];

    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
