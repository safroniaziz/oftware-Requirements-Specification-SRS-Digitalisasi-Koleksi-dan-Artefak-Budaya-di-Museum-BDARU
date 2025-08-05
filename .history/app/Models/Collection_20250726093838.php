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

    /**
     * Get the image URL attribute
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image_path) {
            return null;
        }

        // If it's already a full URL, return as is
        if (filter_var($this->image_path, FILTER_VALIDATE_URL)) {
            return $this->image_path;
        }

        // If it starts with storage/, convert to full URL
        if (str_starts_with($this->image_path, 'storage/')) {
            return asset($this->image_path);
        }

        // Otherwise, assume it's a storage path
        return asset('storage/' . $this->image_path);
    }

    /**
     * Get the video URL attribute
     */
    public function getVideoUrlAttribute()
    {
        if (!$this->video_path) {
            return null;
        }

        if (filter_var($this->video_path, FILTER_VALIDATE_URL)) {
            return $this->video_path;
        }

        if (str_starts_with($this->video_path, 'storage/')) {
            return asset($this->video_path);
        }

        return asset('storage/' . $this->video_path);
    }

    /**
     * Get the PDF URL attribute
     */
    public function getPdfUrlAttribute()
    {
        if (!$this->pdf_path) {
            return null;
        }

        if (filter_var($this->pdf_path, FILTER_VALIDATE_URL)) {
            return $this->pdf_path;
        }

        if (str_starts_with($this->pdf_path, 'storage/')) {
            return asset($this->pdf_path);
        }

        return asset('storage/' . $this->pdf_path);
    }
}
