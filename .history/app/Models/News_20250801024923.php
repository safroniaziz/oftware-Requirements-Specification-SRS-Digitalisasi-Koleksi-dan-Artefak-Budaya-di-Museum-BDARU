<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class News extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'image_path',
        'video_path',
        'type',
        'category_id',
        'news_category_id',
        'event_date',
        'location',
        'is_published',
        'is_featured',
        'view_count',
        'published_at'
    ];

    protected $casts = [
        'event_date' => 'date',
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
        'published_at' => 'datetime'
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function newsCategory()
    {
        return $this->belongsTo(NewsCategory::class);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($news) {
            if (empty($news->slug)) {
                $news->slug = Str::slug($news->title);
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
}
