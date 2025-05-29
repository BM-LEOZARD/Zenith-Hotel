<?php

namespace App\Models;

use App\Models\DataKamar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataReservasi extends Model
{
    use SoftDeletes;
    protected $table = 'data_reservasi';
    protected $fillable = [
        'user_id',
        'nama_customer',
        'data_kamar_id',
        'tanggal_check_in',
        'tanggal_check_out',
        'jumlah_tamu',
        'metode_pembayaran',
        'no_rekening',
        'tipe_kamar',
        'harga',
        'total_harga',
        'status_pembayaran',
        'status_pemesanan',
    ];
    protected $dates = ['tanggal_check_in', 'tanggal_check_out', 'deleted_at'];
    public function dataKamar()
    {
        return $this->belongsTo(DataKamar::class, 'data_kamar_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
