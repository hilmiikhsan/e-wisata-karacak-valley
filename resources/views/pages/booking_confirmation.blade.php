@extends('layouts.front')


@section('content')

    @if ($request->session::has('booking_data'))
        <script>alert('ada data')</script>
    @endif

    <div class="destination_banner_wrap overlay" style="background-image: url('{{ asset('img/default.png') }}')">
        <div class="destination_text text-center">
            <h3>Wisata A
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum, cum.</p>
        </div>
    </div>
    <div class="destination_details_info">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-9">
                    <div class="destination_info">
                        <h3>Detail Pesanan</h3>
                        
                        <ul class="unordered-list mb-4">
                            <li>Tanggal Kunjungan : <b>25 April 2021</b></li>
                            <li>Jumlah Orang : <b>5 Orang</b></li>
                            <li>Jumlah Hari : <b>2 Hari</b></li>
                            <li>Catatan : Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea, magnam!</li>
                        </ul>

                        <div class="card">
                            <div class="card-header">
                                <h5>Detail Pesanan</h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item py-0">
                                    <div class="table-responsive">
                                        <table class="table table-borderless mb-0">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <img src="{{ asset('admin_theme') }}/assets/images/product/prod-1.jpg" alt="contact-img"
                                                            title="contact-img" class="rounded mr-2" height="48">
                                                        <p class="m-0 d-inline-block align-middle">
                                                            <a href="#!" class="text-body font-weight-bold">Wisata Batu Luhur</a>
                                                            <br>
                                                            <small>2 Orang x 3 Hari x 30.000</small>
                                                        </p>
                                                    </td>
                                                    <td class="text-right">
                                                        Rp 90.000
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="{{ asset('admin_theme') }}/assets/images/product/prod-1.jpg" alt="contact-img"
                                                            title="contact-img" class="rounded mr-2" height="48">
                                                        <p class="m-0 d-inline-block align-middle">
                                                            <a href="#!" class="text-body font-weight-semibold">Kolam Renang</a>
                                                            <br>
                                                            <small>2 Orang x 3 Hari x 15.000</small>
                                                        </p>
                                                    </td>
                                                    <td class="text-right">
                                                        Rp 90.000
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </li>
                            </ul>
                            <div class="card-body py-2">
                                <div class="table-responsive">
                                    <table class="table table-borderless mb-0 w-auto table-sm float-right text-right">
                                        <tbody>
                                            <tr class="">
                                                <td>
                                                    <h5 class="m-0">Grand Total:</h5>
                                                </td>
                                                <td class="font-weight-semibold">
                                                    Rp 180.000
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 mt-3">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <div class="submit_btn">
                                <a href="{{ route('booking_cancel') }}" class="boxed-btn4">Batalkan Pesanan</a>
                            </div>
                            
                        </div>
                        <div class="col-md-6 text-right">
                            <div class="submit_btn">
                                <button class="boxed-btn3" type="submit">Konfirmasi Pesanan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
