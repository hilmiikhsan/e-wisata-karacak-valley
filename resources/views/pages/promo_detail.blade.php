@extends('layouts.front')

@section('content')

    {{-- <div class="destination_banner_wrap overlay"
        style="background-image: url('{{ $promo->thumbnail == '' ? asset('img/default.png') : url(Storage::url($promo->thumbnail)) }}')">
    </div> --}}
    <div class="bradcam_area" style="background-image: url('{{ asset('img/promo.jpg') }}')">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="text-center">
                        <h3 style="color: white; font-weight: bold; font-size: 50px;">PROMO DI KARACAK VALLEY</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="destination_details_info">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-9">
                    <div class="destination_info">
                        <h3>{{ $promo->judul }}</h3>
                        <div style="text-align: center;">
                            <img src="{{ $promo->thumbnail == '' ? asset('img/default.png') : url(Storage::url($promo->thumbnail)) }}" alt="{{ $promo->judul }}" style="max-width: 100%; height: 300px; display: inline-block;">
                        </div>
                        <br>
                        <p>{{ \Carbon\Carbon::parse($promo->tanggal)->locale('id')->diffForHumans() }}</p>

                        {!! $promo->deskripsi !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
