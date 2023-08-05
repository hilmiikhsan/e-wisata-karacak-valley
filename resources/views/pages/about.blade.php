@extends('layouts.front')

@section('content')
    <div class="bradcam_area" style="background-image: url('{{ asset('img/bg-about.png') }}')">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text text-center">
                        <h3>Tentang Kami</h3>
                        <p>{{ config('app.name') }} adalah aplikasi berbasis web yang menyediakan informasi tempat-tempat wisata sekaligus tersedia fitur pemesanan sehingga memudahkan pengunjung.</p>
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
                                        <p>{{ config('app.name') }} adalah aplikasi berbasis web yang menyediakan informasi tempat-tempat wisata sekaligus tersedia fitur pemesanan sehingga memudahkan pengunjung</p>
                                        <p>{{ config('app.name') }} adalah aplikasi berbasis web yang menyediakan informasi tempat-tempat wisata sekaligus tersedia fitur pemesanan sehingga memudahkan pengunjung</p>
                                    </div>
                                </div>
                            </div>

                            <div class="counter_wrap">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
