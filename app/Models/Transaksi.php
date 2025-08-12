<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kos_id',
        'penyewa_id',
        'status_transaksi',
        'status_kontak',
        'catatan',
        'balasan_pemilik',
        'tanggal_balasan',
    ];

    protected $casts = [
        'tanggal_balasan' => 'datetime',
    ];

    /**
     * Get the kos that owns the transaksi.
     */
    public function kos()
    {
        return $this->belongsTo(Kos::class);
    }

    /**
     * Get the penyewa (user) that owns the transaksi.
     */
    public function penyewa()
    {
        return $this->belongsTo(User::class, 'penyewa_id');
    }

    /**
     * Scope a query to only include pending transaksi.
     */
    public function scopePending($query)
    {
        return $query->where('status_transaksi', 'pending');
    }

    /**
     * Scope a query to only include completed transaksi.
     */
    public function scopeCompleted($query)
    {
        return $query->where('status_transaksi', 'selesai');
    }

    /**
     * Scope a query to only include pending contact status.
     */
    public function scopePendingContact($query)
    {
        return $query->where('status_kontak', 'pending');
    }

    /**
     * Scope a query to only include contacted status.
     */
    public function scopeContacted($query)
    {
        return $query->where('status_kontak', 'contacted');
    }

    /**
     * Scope a query to only include closed contact status.
     */
    public function scopeClosed($query)
    {
        return $query->where('status_kontak', 'closed');
    }
}
