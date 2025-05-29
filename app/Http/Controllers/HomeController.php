<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $fasilitas = [
            ['nama' => 'Cafe', 'ikon' => 'fas fa-coffee', 'deskripsi' => 'Kami memiliki cafe dengan tema klasik dan vintage.'],
            ['nama' => 'Restoran', 'ikon' => 'fas fa-concierge-bell', 'deskripsi' => 'Kami memiliki restoran dengan tema korean, indonesian, japanese dan chinese food.'],
            ['nama' => 'Bar', 'ikon' => 'fas fa-glass-cheers', 'deskripsi' => 'Kami memiliki Bar dengan tema klasik.'],
            ['nama' => 'Gym', 'ikon' => 'fas fa-dumbbell', 'deskripsi' => 'Kami memiliki Fasilitas olahraga lengkap.'],
            ['nama' => 'Spa', 'ikon' => 'fas fa-spa', 'deskripsi' => 'Kami memiliki ruang spa dengan fasilitas lengkap dan orang berpengalaman.'],
            ['nama' => 'Karaoke', 'ikon' => 'fas fa-music', 'deskripsi' => 'Kami memiliki ruang karaoke dengan fasilitas lengkap.'],
            ['nama' => 'Lapangan Sepak Bola', 'ikon' => 'fas fa-futbol', 'deskripsi' => 'Kami memiliki lapangan sepak bola di outdoor dengan fasilitas lengkap.'],
            ['nama' => 'Lapangan Bola Basket', 'ikon' => 'fa fa-basketball-ball', 'deskripsi' => 'Kami memiliki lapangan bola basket di indoor dengan fasilitas lengkap.'],
            ['nama' => 'Lapangan Golf', 'ikon' => 'fas fa-golf-ball', 'deskripsi' => 'Kami memiliki lapangan golf di outdoor dengan fasilitas lengkap.'],
            ['nama' => 'Lapangan Tenis', 'ikon' => 'fas fa-table-tennis', 'deskripsi' => 'Kami memiliki lapangan tenis di indoor dan outdoor dengan fasilitas lengkap.'],
            ['nama' => 'Arena Bowling', 'ikon' => 'fas fa-bowling-ball', 'deskripsi' => 'Kami memiliki ruangan bowling di indoor dengan fasilitas lengkap.'],
            ['nama' => 'Lapangan Voli', 'ikon' => 'fas fa-volleyball-ball', 'deskripsi' => 'Kami memiliki lapangan voli di indoor dengan fasilitas lengkap.'],
            ['nama' => 'Kolam Renang', 'ikon' => 'fas fa-swimmer', 'deskripsi' => 'Kami memilik kolam renang di indoor dan outdoor.'],
            ['nama' => 'Sauna', 'ikon' => 'fas fa-hot-tub', 'deskripsi' => 'Kami memiliki ruangan sauna di indoor dengan fasilitas lengkap.'],
            ['nama' => 'Game Center', 'ikon' => 'fas fa-gamepad', 'deskripsi' => 'Kami memiliki ruangan game center di indoor dengan fasilitas lengkap.'],
            ['nama' => 'Area Memanah', 'ikon' => 'fas fa-gamepad', 'deskripsi' => 'Kami memiliki ruangan lapangan memanah di outdoor dengan fasilitas lengkap.'],
            ['nama' => 'Penitipan Anak', 'ikon' => 'fas fa-child', 'deskripsi' => 'Kami memiliki ruangan penitipan anak dengan orang yang berpengalaman.'],
            ['nama' => 'Ruang Rapat', 'ikon' => 'fas fa-users', 'deskripsi' => 'Kami memiliki ruangan rapat dengan fasilitas lengkap, termasuk kedap suara.'],
        ];
        return view('index', compact('fasilitas'));
    }
}
