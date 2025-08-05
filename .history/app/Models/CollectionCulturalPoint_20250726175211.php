<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CollectionCulturalPoint extends Model
{
    protected $fillable = [
        'collection_id',
        'title',
        'description',
        'icon',
        'color',
        'order'
    ];

    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }
}
