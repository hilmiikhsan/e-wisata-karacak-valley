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
                            <h5>{{  $title }} </h5>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center m-l-0">
                                <div class="col-sm-6">
                                </div>
                                <div class="col-sm-6 text-right">
                                    <a href="{{ route('dashboard.berita.create') }}"
                                        class="btn btn-success btn-sm mb-3 btn-round"><i class="feather icon-plus"></i>
                                        Tambah</a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mb-0 lara-dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Thumbnail</th>
                                            <th>Judul</th>
                                            <th>Deskripsi</th>
                                            <th>Status</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($post as $item)
                                            <tr>
                                                <td width="10">{{ $loop->iteration }}</td>
                                                <td>
                                                    <img src="{{ ($item->thumbnail == '') ? asset('img/default.png') : url(Storage::url($item->thumbnail)) }}" alt="" style="width: 50px">
                                                </td>
                                                <td>{{ $item->judul }}</td>
                                                <td>{!! Str::limit($item->deskripsi, 30) !!}</td>
                                                <td>
                                                    {!! ($item->is_publish == 1) ? "<span class='badge badge-success'>Publish</span>" : "<span class='badge badge-warning'>Draft</span>" !!}
                                                </td>
                                                <td>{{ $item->tanggal }}</td>
                                                {{-- <td>Dilihat {{ $item->views_count ?? 0 }}x <br> <a href="{{ route('berita.detail', $item->slug) }}">Lihat Berita</a></td> --}}
                                                <td>
                                                    <a href="{{ route('dashboard.berita.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <form method="POST" action="{{ route('dashboard.berita.destroy', $item->id) }}" class="d-inline-block">
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
