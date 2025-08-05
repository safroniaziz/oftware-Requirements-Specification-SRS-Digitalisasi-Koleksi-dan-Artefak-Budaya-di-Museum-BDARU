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
        'photo_upload',
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
        // Prioritas 1: Photo upload (foto yang diupload user)
        if ($this->photo_upload) {
            return asset('storage/' . $this->photo_upload);
        }

        // Prioritas 2: Photo dari API (fallback)
        if ($this->photo) {
            return $this->photo;
        }

        // Prioritas 3: Default photo berdasarkan inisial nama
        $initials = strtoupper(substr($this->name, 0, 2));

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
