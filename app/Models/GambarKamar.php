<?php

namespace App\Models;

use App\Models\DataKamar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GambarKamar extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'gambar_kamar';
    protected $fillable = ['data_kamar_id', 'path'];
    public function dataKamar(): BelongsTo
    {
        return $this->belongsTo(DataKamar::class, 'data_kamar_id');
    }
}
