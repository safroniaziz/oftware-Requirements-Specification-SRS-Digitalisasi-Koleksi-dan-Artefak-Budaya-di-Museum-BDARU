<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'description',
        'photo',
        'email',
        'linkedin',
        'twitter',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    // Get photo URL atau default
    public function getPhotoUrlAttribute()
    {
        if ($this->photo) {
            return $this->photo;
        }

        // Default photo berdasarkan inisial nama
        $initials = strtoupper(substr($this->name, 0, 2));
        $colors = ['emerald', 'teal', 'cyan', 'blue', 'purple', 'pink'];
        $color = $colors[array_rand($colors)];

        return "https://ui-avatars.com/api/?name={$initials}&background=10b981&color=fff&size=128&bold=true";
    }

    // Scope untuk anggota tim yang aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk mengurutkan berdasarkan sort_order
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }
}
