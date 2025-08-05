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
        'email',
        'linkedin',
        'twitter',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];



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
