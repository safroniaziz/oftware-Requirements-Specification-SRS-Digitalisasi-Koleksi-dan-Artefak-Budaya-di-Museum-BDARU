<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CollectionTechnicalSpec extends Model
{
    protected $fillable = [
        'collection_id',
        'spec_name',
        'spec_value',
        'order',
        'icon'
    ];

    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }
}
