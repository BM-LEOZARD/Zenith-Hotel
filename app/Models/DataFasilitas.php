<?php

namespace App\Models;

use App\Models\GambarFasilitas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataFasilitas extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'data_fasilitas';
    protected $fillable = [
        'nama_fasilitas',
        'deskripsi_fasilitas',
    ];
    public function gambarFasilitas(): HasMany
    {
        return $this->hasMany(GambarFasilitas::class, 'data_fasilitas_id');
    }
    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($fasilitas) {
            if (! $fasilitas->isForceDeleting()) {
                $fasilitas->gambarFasilitas()->delete();
            }
        });
        static::restoring(function ($fasilitas) {
            $fasilitas->gambarFasilitas()->withTrashed()->restore();
        });
    }
}
