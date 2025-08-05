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
        'category_id',
        'description',
        'year_period',
        'origin_location',
        'material',
        'dimensions',
        'conservation_status',
        'technical_overview',
        'conservation_overview',
        'nilai_budaya',
        'nilai_historis',
        'nilai_edukatif',
        'image_path',
        'is_active',
        'is_featured',
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

    // New relationships
    public function histories(): HasMany
    {
        return $this->hasMany(CollectionHistory::class)->orderBy('order');
    }

    public function galleryImages(): HasMany
    {
        return $this->hasMany(CollectionGalleryImage::class)->orderBy('order');
    }

    public function technicalSpecs(): HasMany
    {
        return $this->hasMany(CollectionTechnicalSpec::class)->orderBy('order');
    }

    public function conservationRecords(): HasMany
    {
        return $this->hasMany(CollectionConservationRecord::class)->orderBy('order');
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(CollectionRating::class)->where('is_approved', true);
    }

    public function getAverageRatingAttribute()
    {
        return $this->ratings()->avg('rating') ?? 0;
    }

    public function getRatingCountAttribute()
    {
        return $this->ratings()->count();
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
        if (!$this->image_path || empty($this->image_path)) {
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
}
