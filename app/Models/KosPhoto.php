<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KosPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'kos_id',
        'foto_path',
        'is_main'
    ];

    protected $casts = [
        'is_main' => 'boolean',
    ];

    /**
     * Get the kos that owns the photo.
     */
    public function kos()
    {
        return $this->belongsTo(Kos::class);
    }
}
