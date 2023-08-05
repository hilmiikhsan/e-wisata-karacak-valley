@extends('layouts.admin')

@section('content')
    <div class="pc-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- subscribe start -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Master Wisata </h5>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center m-l-0">
                                <div class="col-sm-6">
                                </div>
                                <div class="col-sm-6 text-right">
                                    <a href="{{ route('dashboard.wisata.create') }}"
                                        class="btn btn-success btn-sm mb-3 btn-round"><i class="feather icon-plus"></i>
                                        Tambah Wisata</a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mb-0 lara-dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Thumbnail</th>
                                            <th>Nama Wisata</th>
                                            <th>Harga</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($wisatas as $item)
                                            <tr>
                                                <td width="10">{{ $loop->iteration }}</td>
                                                <td>
                                                    <img src="{{ ($item->thumbnail == '') ? asset('img/default.png') : url(Storage::url($item->thumbnail)) }}" alt="" width="100">
                                                </td>
                                                <td>
                                                    {{ $item->wisata }} <br> 
                                                    <span class="badge badge-primary">{{ ($item->category) ? $item->category->category : ''}}</span>
                                                </td>
                                                <td>{{ number_format($item->price, 2, ",",".") }}</td>
                                                <td>{{ Str::limit($item->address, 10) }}</td>
                                                <td>
                                                    <a href="{{ route('dashboard.wisata.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <form method="POST" action="{{ route('dashboard.wisata.destroy', $item->id) }}" class="d-inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm delete-button">Delete</button>
                                                    </form>
                                                    <a href="{{ route('dashboard.setup_fasilitas', $item->id) }}" class="btn btn-primary btn-sm">Setup Fasilitas</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- subscribe end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
@endsection
