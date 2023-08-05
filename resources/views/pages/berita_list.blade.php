@extends('layouts.front')

@section('content')
<div class="bradcam_area" style="background-image: url('{{ asset('img/bg-about.png') }}')">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text text-center">
                    <h3>List Berita</h3>
                    <p>{{ config('app.name') }} adalah aplikasi berbasis web yang menyediakan informasi tempat-tempat wisata sekaligus tersedia fitur pemesanan sehingga memudahkan pengunjung.</p>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="popular_places_area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section_title text-center mb_70">
                        <h3>Berita Terbaru</h3>
                        <p>Yuk, baca berita terbaru terkait informasi pariwisata di {{ env('APP_NAME') }}</p>

                        @if (isset($keyword))
                            <p class="mt-3">Kata Pencarian: <b>{{ $keyword }}</b></p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($beritas as $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="single_place">
                            <div class="thumb">
                                <img src="{{ ($item->thumbnail == '') ? asset('img/default.png') : url(Storage::url($item->thumbnail)) }}" alt="">
                                <a href="{{ route('berita.detail', $item->slug) }}" class="prise"></a>
                            </div>
                            <div class="place_info">
                            <a href="{{ route('berita.detail', $item->slug) }}">
                                    <h3>{{ $item->judul }}</h3>
                                </a>
                                <p>{!! Str::limit($item->deskripsi, 50) !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
