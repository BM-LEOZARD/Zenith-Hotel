<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MetodePembayaran extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'metode_pembayaran';
    protected $fillable = [
        'metode_pembayaran',
    ];
    protected $dates = [
        'deleted_at',
    ];
    public function reservasi(): HasMany
    {
        return $this->hasMany(DataReservasi::class);
    }
}
