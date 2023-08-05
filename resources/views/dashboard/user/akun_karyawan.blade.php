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
                            <h5>Master Akun Karyawan </h5>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center m-l-0">
                                <div class="col-sm-6">
                                </div>
                                <div class="col-sm-6 text-right">
                                    <a href="{{ route('dashboard.user.create') }}"
                                        class="btn btn-success btn-sm mb-3 btn-round"><i class="feather icon-plus"></i>
                                        Tambah Akun</a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mb-0 lara-dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Avatar</th>
                                            <th>Username</th>
                                            <th>Nama Lengkap</th>
                                            <th>Nomor HP</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $item)
                                            <tr>
                                                <td width="10">{{ $loop->iteration }}</td>
                                                <td width="10" class="text-center">
                                                    <img src="{{ ($item->avatar == '') ? asset('img/default.png') : url(Storage::url($item->avatar)) }}" alt="" style="width: 50px">
                                                </td>
                                                <td>{{ $item->username }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>
                                                    {{ $item->phone }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('dashboard.user.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    @if (!env('IS_DEMO'))
                                                        <form method="POST" action="{{ route('dashboard.user.destroy', $item->id) }}" class="d-inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm delete-button">Delete</button>
                                                        </form>
                                                    @endif
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
