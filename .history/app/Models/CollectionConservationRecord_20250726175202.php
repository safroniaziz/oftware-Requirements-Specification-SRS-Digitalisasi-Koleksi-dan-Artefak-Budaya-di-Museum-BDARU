<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CollectionConservationRecord extends Model
{
    protected $fillable = [
        'collection_id',
        'record_date',
        'action',
        'description',
        'status',
        'color',
        'order'
    ];

    protected $casts = [
        'record_date' => 'date'
    ];

    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }
}
