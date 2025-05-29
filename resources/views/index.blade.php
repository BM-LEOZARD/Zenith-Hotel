@extends('layouts.guest')
@section('title', 'Zenith Hotel | Home')
@section('konten')
    <section class="banner_area">
        <div class="booking_table d_flex align-items-center">
            <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
            <div class="container">
                <div class="banner_content text-center">
                    <h4>zēnəTH | Zenith Hotel </h4>
                    <h3>Selamat Datang di Zenith Hotel</h3>
                    <p>Kami selalu memberikan pelayanan yang terbaik untuk para pelanggan kami.
                        <br>Dengan harga yang relatif terjangkau, anda akan mendapatkan banyak benefit, termasuk kamar
                        premium.
                        <br>Ayo, bergabunglah dengan kami, dan nikmati seluruh fasilitas yang ada.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="accomodation_area section_gap">
        <div class="container">
            <div class="section_title text-center">
                <h2 class="title_color">Tentang kami</h2>
                <p>Selamat datang di <span>Zenith Hotel</span>,
                    tempat di mana kenyamanan, keindahan, dan layanan terbaik bertemu. Terletak strategis di pusat kota,
                    hotel kami menawarkan kemewahan modern dengan sentuhan kehangatan lokal. Dengan desain elegan dan
                    fasilitas lengkap, kami berkomitmen untuk memberikan pengalaman menginap yang tak terlupakan.
                </p>
            </div>
        </div>
    </section>
    <section class="facilities_area section_gap">
        <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" data-background=""></div>
        <div class="container">
            <div class="section_title text-center">
                <h2 class="title_w">Fasilitas <span>Zenith Hotel</span></h2>
                <p>Kami mempunyai sejumlah fasilitas yang bisa anda gunakan.</p>
            </div>
            <div class="swiper-container-wrapper">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        @php
                            $chunked = collect($fasilitas)->chunk(6);
                        @endphp
                        @foreach ($chunked as $group)
                            <div class="swiper-slide">
                                <div class="row mb_30">
                                    @foreach ($group as $item)
                                        <div class="col-lg-4 col-md-6">
                                            <div class="facilities_item">
                                                <h4 class="sec_h4"><i class="{{ $item['ikon'] }}"></i> {{ $item['nama'] }}
                                                </h4>
                                                <p>{{ $item['deskripsi'] ?? 'Deskripsi belum tersedia.' }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new Swiper(".mySwiper", {
                loop: false,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });
        });
    </script>
    <style>
        .swiper-button-next,
        .swiper-button-prev {
            top: 35%;
            transform: translateY(-50%);
            color: #fff;
            z-index: 10;
        }

        @media (max-width: 768px) {

            .swiper-button-next,
            .swiper-button-prev {
                top: 50%;
            }
        }
    </style>
    <section class="about_history_area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-md-6 d_flex align-items-center">
                    <div class="about_content ">
                        <h2 class="title title_color">About Us <br>Our History<br>Mission & Vision</h2>
                        <p>
                            Hotel ini didirikan pada tahun 2000 dengan tujuan untuk menyediakan akomodasi yang nyaman dan
                            layanan yang berkualitas bagi wisatawan dan pebisnis. Sejak itu, hotel ini telah berkembang
                            menjadi salah satu hotel terkemuka di daerah tersebut, dengan reputasi yang baik dan loyalitas
                            pelanggan yang tinggi.<br><br>

                            Visi:<br>
                            "Menjadi hotel terkemuka di daerah ini dengan menyediakan layanan yang berkualitas tinggi,
                            akomodasi yang nyaman, dan pengalaman yang tak terlupakan bagi tamu kami."<br><br>

                            Misi:<br>
                            - Menyediakan layanan yang berkualitas tinggi dan responsif kepada tamu kami.<br>
                            - Menyediakan akomodasi yang nyaman dan bersih dengan harga yang kompetitif.<br>
                            - Meningkatkan kepuasan tamu melalui pengalaman yang tak terlupakan dan pelayanan yang
                            ramah.<br>
                            - Meningkatkan kualitas hidup karyawan melalui pelatihan dan pengembangan yang berkelanjutan.

                            Dengan visi dan misi ini, hotel ini berkomitmen untuk menyediakan pengalaman yang luar biasa
                            bagi tamu kami dan menjadi hotel terkemuka di daerah ini.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <img class="img-fluid" src="{{ asset('website/image/about_bg.jpg') }}" alt="img">
                </div>
            </div>
        </div>
    </section>
@endsection
