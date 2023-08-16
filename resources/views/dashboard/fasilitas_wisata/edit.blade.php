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
                            <h5>{{ $title }}</h5>

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
                            <form method="POST" action="{{ route('dashboard.fasilitas_wisata.update', $facilities->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <img src="{{ $facilities->thumbnail == '' ? asset('img/default.jpg') : url(Storage::url($facilities->thumbnail)) }}" alt="" width="200">
                                        <br>
                                        <label>Thumbnail</label>
                                        <input type="file" class="form-control" name="thumbnail">
                                        <small>Upload gambar jika ingin perbarui</small>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label>Judul</label>
                                        <input type="text" class="form-control" name="judul" value="{{ $facilities->judul }}" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Deskripsi</label>
                                        <textarea class="ckeditor" name="deskripsi" id="deskripsi" cols="30" rows="4">{!! $facilities->deskripsi !!}</textarea>
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
@endpush
