@extends('layouts.front')

@push('css')
    <style>
        #gmap {
            height: 100%;
        }
        .centerMarker {
            position: relative;
            /*url of the marker*/
            background: url(http://maps.gstatic.com/mapfiles/markers2/marker.png) no-repeat;
            /*center the marker*/
            top: 50%;
            left: 50%;
            z-index: 1;
            /*fix offset when needed*/
            margin-left: -10px;
            margin-top: -34px;
            /*size of the image*/
            height: 34px;
            width: 20px;
            cursor: pointer;
            color: black;
        }

    </style>
@endpush

@section('content')

    <div class="destination_banner_wrap overlay"
        style="background-image: url('{{ $berita->thumbnail == '' ? asset('img/default.png') : url(Storage::url($berita->thumbnail)) }}')">
        <div class="destination_text text-center">
            <h3>{{ $berita->judul }}
        </div>
    </div>
    <div class="destination_details_info">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-9">
                    <div class="destination_info">
                        <h3>{{ $berita->judul }}</h3>
                        <p class="text-muted" style="margin-top: -20px;">{{ \Carbon\Carbon::parse($berita->created_at)->locale('id_ID')->isoFormat('dddd, D MMMM Y') }}</p>
                        {!! $berita->deskripsi !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
