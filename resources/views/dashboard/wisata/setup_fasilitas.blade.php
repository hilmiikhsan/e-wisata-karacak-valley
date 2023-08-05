@extends('layouts.admin')

@push('css')
    
@endpush

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
                            <h5>Setup Fasilitas</h5>
                        </div>
                        <a href="javascript:void(0)"><img src="{{ ($wisata->thumbnail != '') ? url(Storage::url($wisata->thumbnail)) : asset('img/default.jpg') }}" alt="Thumbnail" class="img-fluid"></a>

                        <div class="card-body">
                            <a href="javascript:void(0)" class="text-h-primary">
                                <h4>{{ $wisata->wisata }}</h4>
                            </a>
                            <hr>
                            <p class="text-muted mb-0">
                                {!! $wisata->desc !!}
                            </p>
                            <hr>
                            
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
                            <form method="POST" action="{{ route('dashboard.setup_fasilitas_save', $wisata->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Fasilitas Yang Tersedia</label>
                                    @foreach ($facilities as $item)
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input input-primary" name="facilities[]" id="facility_{{ $item->id }}" value="{{ $item->id }}" {{ ($wisata->facilities()->where('facility_id', $item->id)->exists()) > 0 ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="facility_{{ $item->id }}">{{ $item->facility }} | <b> {!! ($item->price > 0) ? "Rp" .  number_format($item->price, 0, ",",".") : "<span class='badge badge-success'>Gratis</span>" !!}</b></label>
                                        </div>
                                    @endforeach
                                    
                                    <small class="form-text text-muted">Ceklis jika ada, uncheck jika tidak ada</small>
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

@endpush
