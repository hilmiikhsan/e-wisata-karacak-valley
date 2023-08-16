@extends('layouts.admin')

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
        .popupContent {
            width: 400px;
        }
    </style>
@endpush

@section('content')
    <div class="pc-container">
        <div class="pcoded-content">
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Dashboard</h5>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading">Selamat Datang {{ Auth::user()->name }}</h4>
                                <p>Selamat {{ Auth::user()->name }}, anda berhasil login ke dalam sistem E-Tiket Karacak Valley,
                                    Silahkan pesan tiket di wisata karacak valley garut</p>
                                <hr>
                                {{-- <p class="mb-0"><a href="{{ route('welcome') }}" class="btn btn-primary">Pilih
                                        Wisata</a></p>
                            </div> --}}
                            <p class="mb-0"><a href="{{ route('dashboard.create') }}" class="btn btn-primary">Pesanan</a></p></div>

                            {{-- <h6 class="mb-20 mt-4">
                                Ayo, Kunjungi Wisata
                            </h6>
                            <div style="height: 500px;">
                                <div id="gmap"></div>
                            </div> --}}
                        </div>
                    </div>
                    <h3>DASHBOARD</h3>
                </div>
                <div class="col-sm-6">
                    <div class="card text-center bg-warning text-white">
                        <div class="card-body">
                            <i class="fas fa-paper-plane f-54 text-mute"></i>
                            <h5 class="m-b-15 m-t-15 text-white">Pesanan Anda</h5>
                            <span class="f-18">{{ $pesanan_undone }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card text-center bg-success text-white">
                        <div class="card-body">
                            <i class="fas fa-cube f-54 text-mute"></i>
                            <h5 class="m-b-15 m-t-15 text-white">Pesanan Selesai</h5>
                            <span class="f-18">{{ $pesanan_done }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
@endsection

@push('js')

    <script src="https://maps.googleapis.com/maps/api/js?&key={{ env('GMAP_API_KEY') }}">
    </script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

    <!-- Marker Clusterer Lib -->

    <script>
        var gmarkers1 = [];
        var markers1 = [];
        var infowindow = new google.maps.InfoWindow({
            content: ''
        });
        let data = {
            'user_id': '{{ auth()->user()->id }}'
        };
        /**
         * Function to init map
         */
        function initialize() {
            var center = new google.maps.LatLng(-6.981818622450134, 108.49000703727529);
            var mapOptions = {
                zoom: 8,
                center: center,
                zoomControl: true,
                mapTypeId: google.maps.MapTypeId.HYBRID
            };
            map = new google.maps.Map(document.getElementById('gmap'), mapOptions);
            $.ajax({
                url: "{{ route('v1.tracking.get_all_wisata') }}",
                dataType: 'json',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                success: function(response) {
                    console.log(response);
                    markers1 = response.map(el => {
                        return {
                            "id": el['id'],
                            "link_detail": el['link_detail'],
                            "price": el['price'],
                            "wisata": el['wisata'],
                            "image": el['image'],
                            "pin_image": el['pin_image'],
                            "lat": parseFloat(el['latitude']),
                            "lng": parseFloat(el['longitude']),
                            "facilities": el['facilities'],
                        }
                    });
                    for (i = 0; i < markers1.length; i++) {
                        addMarker(markers1[i]);
                    }
                }
            })
        }
        /**
         * Function to add marker to map
         */
        function addMarker(marker) {
            var title = marker["wisata"];
            var pos = new google.maps.LatLng(marker["lat"], marker["lng"]);
            var content = `
                <div class="popupContent">
                    <div style="font-size:16px;font-weight:bold;">${marker.wisata}</div>
                    <img src="${marker.image}" style="width:200px;">
                    <p class="my-2" style="margin-bottom:2px;font-size:14px !important;">Harga: <b>Rp ${marker.price}</b> / Orang</p>
                    <p style="margin-bottom:2px;">Fasilitas: <span style="font-size:10px;">${marker.facilities}</span></p>
                    <a href="https://maps.google.com/?saddr=My+Location&daddr=${marker.lat},${marker.lng}" target="_blank" class="btn btn-sm btn-primary">Direction by GMap</a>
                    <a href="${marker.link_detail}" target="_blank" class="btn btn-sm btn-info">Detail</a>
                </div>
            `;
            var theIcon = `${marker.pin_image}`;
            var icon = {
                url: theIcon,
                scaledSize: new google.maps.Size(20, 20)
            };
            marker1 = new google.maps.Marker({
                title: title,
                position: pos,
                map: map,
                icon: icon
            });
            gmarkers1.push(marker1);
            // Marker click listener
            google.maps.event.addListener(marker1, 'click', (function(marker1, content) {
                return function() {
                    infowindow.setContent(content);
                    infowindow.open(map, marker1);
                    map.panTo(this.getPosition());
                }
            })(marker1, content));
        }
        filterMarkers = function(category) {
            for (i = 0; i < gmarkers1.length; i++) {
                marker = gmarkers1[i];
                // If is same category or category not picked
                if (marker.category == category || category.length === 0) {
                    //Close InfoWindows
                    marker.setVisible(true);
                    if (infowindow) {
                        infowindow.close();
                    }
                }
                // Categories don't match
                else {
                    marker.setVisible(false);
                }
            }
        }
        // Init map
        initialize();
    </script>


@endpush
