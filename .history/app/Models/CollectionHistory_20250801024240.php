<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CollectionHistory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'collection_id',
        'title',
        'year',
        'description',
        'order',
        'color'
    ];

    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }
}
