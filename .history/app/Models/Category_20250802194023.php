<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Accessor untuk icon default
    public function getIconAttribute($value)
    {
        return $value ?: 'fas fa-tag'; // Default icon jika tidak ada
    }

    public function collections(): HasMany
    {
        return $this->hasMany(Collection::class);
    }

    public function getActiveCollectionsCountAttribute()
    {
        return $this->collections()->where('is_active', true)->count();
    }

    public function news(): HasMany
    {
        return $this->hasMany(News::class);
    }
}
