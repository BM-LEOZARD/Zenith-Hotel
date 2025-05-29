<?php

namespace App\Models;

use App\Models\DataFasilitas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GambarFasilitas extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'gambar_fasilitas';
    protected $fillable = ['data_fasilitas_id', 'path'];
    public function dataFasilitas(): BelongsTo
    {
        return $this->belongsTo(DataFasilitas::class, 'data_fasilitas_id');
    }
}
