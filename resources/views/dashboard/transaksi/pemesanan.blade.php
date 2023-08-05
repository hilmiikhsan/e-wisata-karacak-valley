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
                            <h5>Data Pemesanan</h5>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center m-l-0">
                                <div class="col-sm-6">
                                </div>
                                <div class="col-sm-6 text-right">
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mb-0 lara-dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kode Transaksi</th>
                                            <th>Pemesan (Member)</th>
                                            <th>Wisata</th>
                                            <th>Jml Orang & Hari</th>
                                            <th>Tanggal Booking </th>
                                            <th>Tanggal Kedatangan </th>
                                            <th>Grand Total</th>
                                            <th>Status Pembayaran</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactions as $item)
                                            <tr>
                                                <td width="10">{{ $loop->iteration }}</td>
                                                <td>{{ $item->trans_code }}</td>
                                                <td>{{ $item->member->name }}</td>
                                                <td>{{ $item->wisata->wisata }}</td>
                                                <td>
                                                    {{ $item->people_count }} Orang <br>
                                                    {{ $item->days }} Hari
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('dddd, D MMMM Y | H:mm A') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->check_in)->locale('id_ID')->isoFormat('dddd, D MMMM Y') }}</td>
                                                <td>
                                                    {!! ($item->grand_total > 0) ? "Rp. " . number_format($item->grand_total, 0, ",",".") : "Rp 0" !!}
                                                </td>
                                                <td>
                                                    @if ($item->status == 1)
                                                        <div class="badge badge-success">
                                                            <i class="feather icon-check-circle mr-2"></i>Pembayaran Diverifikasi Lunas
                                                        </div>
                                                    @else
                                                        <div class="badge badge-warning">
                                                            <i class="feather icon-check-circle mr-2"></i>Pembayaran Belum Diverifikasi Lunas
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('dashboard.transaction.detail', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                                                    @if (Auth::user()->role == 'super_admin')
                                                        <form method="POST" action="{{ route('dashboard.transaction.destroy', $item->id) }}" class="d-inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm delete-button">Hapus</button>
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
