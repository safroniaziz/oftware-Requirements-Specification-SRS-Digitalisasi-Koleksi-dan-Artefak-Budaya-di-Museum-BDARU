<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CollectionQrCode extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'collection_id',
        'qr_code',
        'qr_image_path',
        'is_active',
        'scan_count',
        'last_scanned_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'scan_count' => 'integer',
        'last_scanned_at' => 'datetime',
    ];

    // Relationship with Collection
    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }

    // Generate unique QR code
    public static function generateUniqueQrCode()
    {
        do {
            $qrCode = 'QR-' . strtoupper(substr(md5(uniqid()), 0, 8));
        } while (self::where('qr_code', $qrCode)->exists());

        return $qrCode;
    }

    // Get QR code URL
    public function getQrUrlAttribute()
    {
        return route('collections.show', $this->collection->slug) . '?qr=' . $this->qr_code;
    }
}
