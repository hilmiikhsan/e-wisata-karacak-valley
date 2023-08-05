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
                            <h5>Edit Fasilitas</h5>
                            
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
                            <form method="POST" action="{{ route('dashboard.fasilitas.update', $facility->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <img src="{{ $facility->thumbnail == '' ? asset('img/default.jpg') : url(Storage::url($facility->thumbnail)) }}" alt="" width="200">
                                        <br>
                                        <label>Thumbnail</label>
                                        <input type="file" class="form-control" name="thumbnail">
                                        <small>Upload gambar jika ingin perbarui</small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Harga</label>
                                        <input type="number" class="form-control" name="price" placeholder="Harga" value="{{ $facility->price }}">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Fasilitas</label>
                                        <input type="text" class="form-control" name="facility" placeholder="Fasilitas" value="{{ $facility->facility }}">
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
