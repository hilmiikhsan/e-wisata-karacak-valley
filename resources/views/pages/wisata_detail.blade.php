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
        style="background-image: url('{{ $wisata->thumbnail == '' ? asset('img/default.png') : url(Storage::url($wisata->thumbnail)) }}')">
        <div class="destination_text text-center">
            <h3>{{ $wisata->wisata }}
                <p>{{ $wisata->address }}</p>
        </div>
    </div>
    <div class="destination_details_info">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-9">
                    <div class="destination_info">
                        <h3>Deskripsi</h3>

                        {!! $wisata->desc !!}
                        <h4 class="mb-5">
                            <b>Harga: Rp {{ number_format($wisata->price, 0, ',', '.') }}</b> / Orang
                        </h4>
                        <h3 class="mb-20">Fasilitas Tersedia</h3>
                        <div class="col-md-12 mt-sm-30">
                            <div class="">
                                <ul class="unordered-list">
                                    @foreach ($wisata->facilities as $item)
                                        <li>{{ $item->facility }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <h3 class="mb-20 mt-5">
                            Lokasi Wisata
                        </h3>
                        <div style="height: 300px;">
                            <div id="gmap"></div>
                        </div>
                    </div>

                    @if (Auth::check() && Auth::user()->role == 'member')
                        <div class="bordered_1px"></div>
                        <div class="contact_join">
                            <h3>Hai {{ Auth::user()->name }}, Mau Booking Wisata Ini ?</h3>
                            <form method="POST" action="{{ route('booking', $wisata->id) }}">
                                @csrf
                                <div class="row justify-content-center">
                                    @if ($errors->any())
                                        @foreach ($errors->all() as $item)
                                            <div class="alert alert-danger" role="alert">
                                                {{ $item }}
                                            </div>
                                        @endforeach
                                    @endif
                                    <div class="col-lg-8 col-md-8">
                                        <div class="single-element-widget mt-30">
                                            <h5 class="mb-30">Fasilitas</h5>
                                            @foreach ($wisata->facilities as $item)
                                                <div class="switch-wrap d-flex justify-content-between">
                                                    <p>{{ $item->facility }} <b> {!! $item->price > 0 ? 'Rp' . number_format($item->price, 0, ',', '.') : "<span class='badge badge-success'>Gratis</span>" !!}</b></p>
                                                    <div class="primary-checkbox">
                                                        <input type="checkbox" name="facilities[]"
                                                            id="facility_{{ $item->id }}" value="{{ $item->id }}"
                                                            {{ $item->price == 0 ? 'checked' : '' }}>
                                                        <label for="facility_{{ $item->id }}"></label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-lg-4 col-md-4">
                                        <div class="single_input">
                                            <h5>Jumlah Orang</h5>
                                            <input type="number" name="people_count" min="1" max="50" placeholder="Berapa Orang?" value="1">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="single_input">
                                            <h5>Tanggal Datang</h5>
                                            <input type="date" name="check_in" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="single_input">
                                            <h5>Berapa Hari?</h5>
                                            <input type="number" name="days" min="1" max="7" placeholder="Berapa Hari?" value="1">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single_input">
                                            <textarea name="message" id="message" cols="30" rows="10"
                                                placeholder="Pesan/Catatan"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="submit_btn">
                                            <button class="boxed-btn4" type="submit">Pesan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    @else
                        <div class="bordered_1px"></div>
                        <div class="contact_join">
                            <h3>Booking Wisata Ini ?</h3>
                            <a href="{{ route('register') }}" class="boxed-btn4">Daftar jadi member sekarang!</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
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
@endpush
