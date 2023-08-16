@extends('layouts.front')

@section('content')
    <div class="bradcam_area" style="background-image: url('{{ asset('img/about.jpg') }}')">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="text-center">
                        <h3>TENTANG KAMI KARACAK VALLEY</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="about_story">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="story_heading">
                        <h3>{{ config('app.name') }}</h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-11 offset-lg-1">
                            <div class="story_info">
                                <div class="row">
                                    <div class="col-lg-9">
                                        <p>Aplikasi Berbasis website yang menyediakan informasi wisata sekaligus tersedia fitur
                                            pemesanan sehingga memudahkan wisatawan dalam pembelian tiket online. <br><br>

                                            "Karacak Valley Garut merupakan salah satu Tempat wisata alam gunung dan perbukitan
                                             di Garut berupa hutan pinus dan perkebunan kopi yang secara resmi dibuka pada awal tahun 2016,
                                            dan menjadi destinasi wisata yang hits, banyaknya fasilitas-fasilitas yang membuat wisatawan
                                            senang untuk berlibur dikaracak valley dengan hutan pinus nya yang indah, suasana alam
                                            pegunungan, udara yang sejuk . Karacak Valley dapat dijadikan lokasi healing di Garut
                                            yang recommended, menikmati alam yang indah serta view yang menawan dapat mengobati
                                            rasa lelah dalam jiwa dan raga."<br><br>

                                            Wisata Karacak Valley berada di Jalan Karacak Valley Margawati, Sukanegla,
                                            Kec. Garut Kota, Kabupaten Garut, Jawa Barat 44113
                                            Jam operasional Karacak Valley : Setiap Hari, mulai pukul 08:00 s/d 17:00 WIB
                                            Untuk yang hendak camping terbuka selama 24 jam nonstop.</p>
                                            <p>Berikut ini map wisata di karacak valley</p>
                                    </div>
                                </div>
                            </div>

                            <div class="d-none d-sm-block mb-5 pb-4">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15884.756380379217!2d107.9508674!3d-7.2693522!3m2!1i1024!2i768!4f13.1!4m3!3e6!4m0!4m0!5e0!3m2!1sen!2sid!4v1644505495032" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                            </div>

                            {{-- <div class="counter_wrap">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4">
                                        <div class="single_counter text-center">
                                            <h3 class="counter">{{ $wisata }}</h3>
                                            <p>Wisata Terpublikasikan</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="single_counter text-center">
                                            <h3 class="counter">{{ $fasilitas }}</h3>
                                            <p>Fasilitas Terpublikasikan</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="single_counter text-center">
                                            <h3 class="counter">{{ $member }}</h3>
                                            <p>Member Bergabung</p>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
