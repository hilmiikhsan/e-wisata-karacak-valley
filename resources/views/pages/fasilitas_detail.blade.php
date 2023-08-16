@extends('layouts.front')

{{-- @push('css')
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
@endpush --}}

@section('content')

    <div class="destination_banner_wrap overlay"
        style="background-image: url('{{ $fasilitas->thumbnail == '' ? asset('img/default.png') : url(Storage::url($fasilitas->thumbnail)) }}')">
        {{-- <div class="destination_text text-center">
            <h3>{{ $fasilitas->judul }}
                <p>{{ $fasilitas->address }}</p>
        </div> --}}
    </div>
    <div class="destination_details_info">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-9">
                    <div class="destination_info">
                        <h3>{{ $fasilitas->judul }}</h3>

                        {!! $fasilitas->deskripsi !!}
                        <h3 class="mb-20">Fasilitas Tersedia</h3>
                        {{-- <div class="col-md-12 mt-sm-30">
                            <div class="">
                                <ul class="unordered-list">
                                    @foreach ($fasilitas->facility as $item)
                                        <li>{{ $item->judul }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div> --}}

                        {{-- <h3 class="mb-20 mt-5">
                            Lokasi Wisata
                        </h3>
                        <div style="height: 300px;">
                            <div id="gmap"></div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @push('js')
    <script
        src="https://maps.googleapis.com/maps/api/js?&key={{ env('GMAP_API_KEY') }}&callback=initMap" async defer>
    </script>

    <script>
        function initMap() {
            const myLatLng = {
                lat: {{ $wisata->latitude == '' ? -25.363 : $wisata->latitude}},
                lng: {{ $wisata->longitude == '' ? 131.044 : $wisata->longitude }}
            };
            const map = new google.maps.Map(document.getElementById("gmap"), {
                zoom: 9,
                center: myLatLng,
            });
            new google.maps.Marker({
                position: myLatLng,
                map,
                title: "Lokasi {{ $wisata->wisata }}",
            });
        }

    </script>
@endpush --}}
