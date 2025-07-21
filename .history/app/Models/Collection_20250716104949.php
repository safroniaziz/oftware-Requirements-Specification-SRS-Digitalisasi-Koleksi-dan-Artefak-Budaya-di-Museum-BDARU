<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

class Collection extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'description',
        'year_period',
        'origin_location',
        'image_path',
        'video_path',
        'pdf_path',
        'qr_code_path',
        'is_featured',
        'is_active',
        'view_count'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class);
    }

    public function generateQrCode()
    {
        $url = route('collections.show', $this->slug);
        $qrCode = QrCode::format('png')->size(300)->generate($url);

        $filename = 'qr-codes/' . $this->slug . '.png';
        $path = storage_path('app/public/' . $filename);

        // Ensure directory exists
        if (!file_exists(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }

        file_put_contents($path, $qrCode);

        $this->update(['qr_code_path' => $filename]);

        return $filename;
    }

    public function incrementViewCount()
    {
        $this->increment('view_count');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($collection) {
            if (empty($collection->slug)) {
                $collection->slug = Str::slug($collection->name);
            }
        });
    }
}
