<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\DataReservasi;
use Illuminate\Console\Command;

class UpdateReservasiStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reservasi:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update status reservasi menjadi Complete jika sudah lewat tanggal check-out';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();
        $reservasiList = DataReservasi::where('status_pemesanan', 'Check-In')
            ->where('tanggal_check_out', '<=', $now)
            ->get();
        $this->info("Memeriksa reservasi... {$reservasiList->count()} ditemukan.");
        foreach ($reservasiList as $reservasi) {
            $reservasi->status_pemesanan = 'Complete';
            $reservasi->save();
            if ($reservasi->dataKamar) {
                $masihAda = DataReservasi::where('data_kamar_id', $reservasi->data_kamar_id)
                    ->whereIn('status_pemesanan', ['Check-In', 'Verified'])
                    ->where('id', '!=', $reservasi->id)
                    ->where('tanggal_check_out', '>', $now)
                    ->exists();
                if (! $masihAda) {
                    $reservasi->dataKamar->status_kamar = 'Tersedia';
                    $reservasi->dataKamar->save();
                    $this->info("Kamar #{$reservasi->data_kamar_id} tersedia kembali.");
                } else {
                    $this->info("Kamar #{$reservasi->data_kamar_id} masih digunakan oleh reservasi lain.");
                }
            }
        }
        return Command::SUCCESS;
    }
}
