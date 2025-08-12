<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kos extends Model
{
    use HasFactory;

    protected $table = 'kos';

    protected $fillable = [
        'nama_kos',
        'lokasi',
        'harga',
        'fasilitas',
        'deskripsi',
        'foto',
        'status_ketersediaan',
        'user_id',
        'is_verified',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'is_verified' => 'boolean',
    ];

    /**
     * Get the pemilik (user) that owns the kos.
     */
    public function pemilik()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the transaksi for the kos.
     */
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }

    /**
     * Scope a query to only include verified kos.
     */
    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    /**
     * Scope a query to only include available kos.
     */
    public function scopeAvailable($query)
    {
        return $query->where('status_ketersediaan', 'tersedia');
    }
}
