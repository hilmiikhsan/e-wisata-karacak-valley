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
                            <h5>Master Fasilitas </h5>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center m-l-0">
                                <div class="col-sm-6">
                                </div>
                                <div class="col-sm-6 text-right">
                                    <a href="{{ route('dashboard.fasilitas.create') }}"
                                        class="btn btn-success btn-sm mb-3 btn-round"><i class="feather icon-plus"></i>
                                        Tambah Fasilitas</a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mb-0 lara-dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Thumbnail</th>
                                            <th>Judul</th>
                                            <th>Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($facilities as $item)
                                            <tr>
                                                <td width="10">{{ $loop->iteration }}</td>
                                                <td>
                                                    <img src="{{ ($item->thumbnail == '') ? asset('img/default.png') : url(Storage::url($item->thumbnail)) }}" alt="" style="width: 50px">
                                                </td>
                                                <td>{{ $item->facility }}</td>
                                                <td>
                                                    {!! ($item->price > 0) ? "Rp. " . number_format($item->price, 0, ",",".") : "<span class='badge badge-success'>Gratis</span>" !!}
                                                </td>
                                                <td>
                                                    <a href="{{ route('dashboard.fasilitas.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <form method="POST" action="{{ route('dashboard.fasilitas.destroy', $item->id) }}" class="d-inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm delete-button">Delete</button>
                                                    </form>
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
