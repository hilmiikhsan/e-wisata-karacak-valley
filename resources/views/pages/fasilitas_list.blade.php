@extends('layouts.front')

@section('content')
<div class="bradcam_area" style="background-image: url('{{ asset('img/fasilitas.jpg') }}')">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="text-center">
                    <h3 style="color: white; font-weight: bold; font-size: 50px;">FASILITAS- FASILITAS KARACAK VALLEY</h3>
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
                        <h3>FASILITAS WISATA KARACAK VALLEY</h3>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($fasilitas as $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="single_place">
                            <div class="thumb">
                                <img src="{{ ($item->thumbnail == '') ? asset('img/default.png') : url(Storage::url($item->thumbnail)) }}" alt="">
                            </div>
                            <div class="place_info">
                            <a href="{{ route('fasilitas.detail', $item->slug) }}">
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
