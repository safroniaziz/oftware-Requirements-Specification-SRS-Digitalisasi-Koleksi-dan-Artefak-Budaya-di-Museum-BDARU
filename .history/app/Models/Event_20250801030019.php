<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'event_date',
        'event_time',
        'location',
        'image_path',
        'status',
        'type',
        'capacity',
        'price',
        'is_featured',
        'organizer',
        'additional_info',
    ];

    protected $casts = [
        'event_date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'price' => 'decimal:2',
        'is_featured' => 'boolean',
    ];

    public function scopeUpcoming($query)
    {
        return $query->where('event_date', '>=', now()->toDateString())
                    ->where('status', 'upcoming');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function getFormattedDateAttribute()
    {
        return $this->event_date->format('d M Y');
    }

    public function getFormattedTimeAttribute()
    {
        $time = $this->start_time->format('H:i');
        if ($this->end_time) {
            $time .= ' - ' . $this->end_time->format('H:i');
        }
        return $time;
    }

    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'upcoming' => 'blue',
            'ongoing' => 'green',
            'completed' => 'gray',
            'cancelled' => 'red',
            default => 'gray',
        };
    }

    public function getTypeIconAttribute()
    {
        return match($this->type) {
            'exhibition' => '🎨',
            'workshop' => '🔧',
            'seminar' => '📚',
            'performance' => '🎭',
            'other' => '📅',
            default => '📅',
        };
    }

    /**
     * Get the image URL attribute
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image || empty($this->image)) {
            return null;
        }

        // If it's already a full URL, return as is
        if (filter_var($this->image, FILTER_VALIDATE_URL)) {
            return $this->image;
        }

        // If it starts with storage/, convert to full URL
        if (str_starts_with($this->image, 'storage/')) {
            return asset($this->image);
        }

        // Otherwise, assume it's a storage path
        return asset('storage/' . $this->image);
    }
}
