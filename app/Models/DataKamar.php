<?php

namespace App\Models;

use App\Models\GambarKamar;
use App\Models\DataReservasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataKamar extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'data_kamar';
    protected $fillable = [
        'nomor_kamar',
        'tipe_kamar',
        'harga_per_malam',
        'status_kamar',
        'deskripsi_kamar',
    ];
    public function gambarKamar(): HasMany
    {
        return $this->hasMany(GambarKamar::class, 'data_kamar_id');
    }
    public function reservasi()
    {
        return $this->hasMany(DataReservasi::class, 'data_kamar_id');
    }
    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($kamar) {
            if (! $kamar->isForceDeleting()) {
                $kamar->gambarKamar()->delete();
            }
        });
        static::restoring(function ($kamar) {
            $kamar->gambarKamar()->withTrashed()->restore();
        });
    }
}
