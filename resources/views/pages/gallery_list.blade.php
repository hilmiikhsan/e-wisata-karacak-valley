@extends('layouts.front')

@section('content')
<div class="bradcam_area" style="background-image: url('{{ asset('img/gallery.jpg') }}')">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="text-center">
                    <h3 style="color: white; font-weight: bold; font-size: 50px;">GALLERY DI KARACAK VALLEY</h3>
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
                        <h3>GALLERY DI KARACAK VALLEY</h3>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($galleries as $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="single_place">
                            <a href="{{ ($item->thumbnail == '') ? asset('img/default.png') : url(Storage::url($item->thumbnail)) }}" data-lightbox="gallery" data-title="{{ $item->judul }}">
                                <div class="thumb">
                                    <img src="{{ ($item->thumbnail == '') ? asset('img/default.png') : url(Storage::url($item->thumbnail)) }}" alt="">
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection

@push('js')
<script>
    // Inisialisasi Lightbox
    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true
    });
</script>
@endpush
