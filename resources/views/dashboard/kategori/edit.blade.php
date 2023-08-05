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
                            <h5>Edit Kategori</h5>
                            
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
                            <form method="POST" action="{{ route('dashboard.kategori.update', $category->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <img src="{{ $category->thumbnail == '' ? asset('img/default.jpg') : url(Storage::url($category->thumbnail)) }}" alt="" width="200">
                                        <br>
                                        <label>Thumbnail</label>
                                        <input type="file" class="form-control" name="thumbnail">
                                        <small>Upload gambar jika ingin perbarui</small>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Nama Kategori</label>
                                        <input type="text" class="form-control" name="category" placeholder="Kategori" value="{{ $category->category }}">
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
