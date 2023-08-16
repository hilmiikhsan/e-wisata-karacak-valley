@extends('layouts.front')

@section('content')
<div class="bradcam_area" style="background-image: url('{{ asset('img/blog.jpg') }}')">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text text-center">
                    <h3>BLOG DI <br> KARACAK VALLEY</h3>
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
                        <h3>LIST ARTIKEL KARACAK VALLEY</h3>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($beritas as $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="single_place">
                            <div class="thumb">
                                <img src="{{ ($item->thumbnail == '') ? asset('img/default.png') : url(Storage::url($item->thumbnail)) }}" alt=""
                                style="max-width: 100%; height: 300px; object-fit: cover; display: block; margin: 0 auto;">
                                <a href="{{ route('berita.detail', $item->slug) }}" class="prise"></a>
                            </div>
                            <div class="place_info">
                            <a href="{{ route('berita.detail', $item->slug) }}">
                                    <h3>{{ $item->judul }}</h3>
                                </a>
                                <p>{!! Str::limit($item->deskripsi, 50) !!}</p>
                                <p>{{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
