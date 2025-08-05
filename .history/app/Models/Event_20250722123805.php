<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'event_date',
        'start_time',
        'end_time',
        'location',
        'image',
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
}
