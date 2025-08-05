<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeamMember extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'position',
        'description',
        'photo',
        'email',
        'linkedin',
        'twitter',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
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

    // Scope untuk mengurutkan berdasarkan nama
    public function scopeOrdered($query)
    {
        return $query->orderBy('name', 'asc');
    }
}
