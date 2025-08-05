<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'profession',
        'content',
        'message',
        'rating',
        'avatar',
        'email',
        'phone',
        'user_id',
        'is_approved',
        'visitor_name',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];

    // Scope untuk semua testimoni (tidak ada approval)
    public function scopeApproved($query)
    {
        return $query; // Return semua testimoni
    }

    // Scope untuk testimoni unggulan (rating tinggi)
    public function scopeFeatured($query)
    {
        return $query->where('rating', '>=', 4);
    }

    // Get avatar URL atau default
    public function getAvatarUrlAttribute()
    {
        if ($this->avatar) {
            return $this->avatar;
        }

        // Default avatar berdasarkan inisial nama
        $initials = strtoupper(substr($this->name, 0, 1));
        $colors = ['emerald', 'teal', 'cyan', 'blue', 'purple', 'pink'];
        $color = $colors[array_rand($colors)];

        return "https://ui-avatars.com/api/?name={$initials}&background=10b981&color=fff&size=128&bold=true";
    }

    // Relationship dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
