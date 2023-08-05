@extends('layouts.admin')

@section('content')
    <div class="pc-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Tambah Wisata</h5>

                        </div>
                        <div class="card-body">
                            @if (Session::has('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session::get('success') }}
                                </div>
                            @endif
                            @if ($errors->any())
                                @foreach ($errors->all() as $item)
                                    <div class="alert alert-danger" role="alert">
                                        {{ $item }}
                                    </div>
                                @endforeach
                            @endif
                            <form method="POST" action="{{ route('dashboard.wisata.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Thumbnail</label>
                                        <input type="file" class="form-control" name="thumbnail">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Harga Tiket Masuk</label>
                                        <input type="number" class="form-control" name="price" placeholder="Harga" required>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label>Nama Wisata</label>
                                        <input type="text" class="form-control" name="wisata" placeholder="Nama Wisata"
                                            required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Kategori</label>
                                        <select name="category_id" id="category_id" class="form-control" required>
                                            @foreach ($categories as $item)
                                                <option value="{{ $item->id }}">{{ $item->category }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Deskripsi Wisata</label>
                                        <textarea class="ckeditor" name="desc" id="desc" cols="30" rows="4"></textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Alamat Lengkap</label>
                                        <textarea class="form-control" name="address" id="address" cols="30"
                                            rows="4"></textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Koordinat Wisata</label>
                                        <div id="gmap" style="height: 300px;"></div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Latitude</label>
                                        <input type="text" class="form-control" name="latitude" id="latitude">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Longitude</label>
                                        <input type="text" class="form-control" name="longitude" id="longitude">
                                    </div>
                                </div>
                                <button type="submit" class="btn  btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
@endsection

@push('js')
    <!-- CKEditor -->
    <script src="{{ asset('admin_theme') }}/assets/plugins/ckeditor/ckeditor.js"></script>

    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key={{ env('GMAP_API_KEY') }}&callback=initMap">
    </script>

    <script>
        var map = null;
        var marker;

        function showlocation() {
            if ("geolocation" in navigator) {
                /* geolocation is available */
                // One-shot position request.
                navigator.geolocation.getCurrentPosition(callback, error);
            } else {
                /* geolocation IS NOT available */
                console.warn("geolocation IS NOT available");
            }
        }

        function error(err) {
            console.warn('ERROR(' + err.code + '): ' + err.message);
        };

        function callback(position) {

            var lat = position.coords.latitude;
            var lon = position.coords.longitude;
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lon;
            var latLong = new google.maps.LatLng(lat, lon);
            map.setZoom(16);
            map.setCenter(latLong);
        }
        google.maps.event.addDomListener(window, 'load', initMap);

        var longitude = 95.0240056;
        var latitude = 5.5612605;

        function initMap() {
            var mapOptions = {
                center: new google.maps.LatLng(latitude, longitude),
                zoom: 6,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById("gmap"),
                mapOptions);
            google.maps.event.addListener(map, 'center_changed', function() {
                document.getElementById('latitude').value = map.getCenter().lat();
                document.getElementById('longitude').value = map.getCenter().lng();
            });
            $('<div/>').addClass('centerMarker').appendTo(map.getDiv())
                //do something onclick
                .click(function() {
                    var that = $(this);
                    if (!that.data('win')) {
                        that.data('win', new google.maps.InfoWindow({
                            content: '<p class="marker_title">Marker Lokasi</p>'
                        }));
                        that.data('win').bindTo('position', map, 'center');
                    }
                    that.data('win').open(map);
                });

            var input = document.getElementById('searchTextField');
            var autocomplete = new google.maps.places.Autocomplete(input);
            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                var place = autocomplete.getPlace();
                // document.getElementById('city2').value = place.name;
                document.getElementById('latitude').value = place.geometry.location.lat();
                document.getElementById('longitude').value = place.geometry.location.lng();
                //alert("This function is working!");
                //alert(place.name);
                // alert(place.address_components[0].long_name);
                var lat = place.geometry.location.lat();
                var lng = place.geometry.location.lng();
                var latLong = new google.maps.LatLng(lat, lng);
                map.setCenter(latLong);

            });
        }

    </script>
@endpush
