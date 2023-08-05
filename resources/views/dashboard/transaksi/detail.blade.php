@extends('layouts.admin')

@push('css')
    <!-- Rating css -->
    <link rel="stylesheet" href="{{ asset('admin_theme') }}/assets/css/plugins/bars-1to10.css">
    <link rel="stylesheet" href="{{ asset('admin_theme') }}/assets/css/plugins/bars-horizontal.css">
    <link rel="stylesheet" href="{{ asset('admin_theme') }}/assets/css/plugins/bars-movie.css">
    <link rel="stylesheet" href="{{ asset('admin_theme') }}/assets/css/plugins/bars-pill.css">
    <link rel="stylesheet" href="{{ asset('admin_theme') }}/assets/css/plugins/bars-reversed.css">
    <link rel="stylesheet" href="{{ asset('admin_theme') }}/assets/css/plugins/bars-square.css">
    <link rel="stylesheet" href="{{ asset('admin_theme') }}/assets/css/plugins/bootstrap-stars.css">
    <link rel="stylesheet" href="{{ asset('admin_theme') }}/assets/css/plugins/css-stars.css">
@endpush

@section('content')
    <div class="pc-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="card user-card user-card-1">
                        <div class="card-body pb-0">
                            <div class="media user-about-block align-items-center mt-0 mb-3">
                                <div class="media-body ml-3">
                                    <h4 class="mb-1"><i class="feather icon-lock mr-1"></i> Kode Transaksi:
                                        {{ $transaction->trans_code }}</h4>
                                </div>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item py-0">
                                    <div class="table-responsive">
                                        <table class="table table-borderless mb-0">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <img src="{{ $transaction->wisata->thumbnail == '' ? asset('img/default.png') : url(Storage::url($transaction->wisata->thumbnail)) }}"
                                                            alt="contact-img" title="contact-img" class="rounded mr-2"
                                                            height="48">
                                                        <p class="m-0 d-inline-block align-middle">
                                                            <a href="#!"
                                                                class="text-body font-weight-bold">{{ $transaction->wisata->wisata }}</a>
                                                            <br>
                                                            <small>{{ $transaction->people_count }} Orang x
                                                                {{ $transaction->days }} Hari x Rp.
                                                                {{ $transaction->wisata->price }}</small>
                                                        </p>
                                                    </td>
                                                    <td class="text-right">
                                                        Rp.
                                                        {{ number_format($transaction->people_count * $transaction->days * $transaction->wisata->price, 0, ',', '.') }}
                                                    </td>
                                                </tr>
                                                @php
                                                    $grand_total = $transaction->people_count * $transaction->days * $transaction->wisata->price;
                                                @endphp
                                                @foreach ($transaction->transaksi_detail as $item)
                                                    @php
                                                        $facility = \App\Fasilitas::find($item->facility_id);
                                                    @endphp
                                                    <tr>
                                                        <td>
                                                            <img src="{{ $facility->thumbnail == '' ? asset('img/default.png') : url(Storage::url($facility->thumbnail)) }}"
                                                                alt="contact-img" title="contact-img" class="rounded mr-2"
                                                                height="48">
                                                            <p class="m-0 d-inline-block align-middle">
                                                                <a href="#!"
                                                                    class="text-body font-weight-semibold">{{ $facility->facility }}</a>
                                                                <br>
                                                                <small>{{ $transaction->people_count }} Orang x
                                                                    {{ $transaction->days }} Hari x
                                                                    {{ $facility->price }}</small>
                                                            </p>
                                                        </td>
                                                        <td class="text-right">
                                                            Rp
                                                            {{ number_format($transaction->people_count * $transaction->days * $facility->price, 0, ',', '.') }}
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $grand_total += $transaction->people_count * $transaction->days * $facility->price;
                                                    @endphp
                                                @endforeach
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
                                                    Rp {{ number_format($grand_total, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <h5 class="mt-5">Pesan/Catatan</h5>
                                <p>
                                    {{ $transaction->message }}
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="tab-content" id="user-set-tabContent">
                        <div class="tab-pane fade show active" id="user-set-profile" role="tabpanel"
                            aria-labelledby="user-set-profile-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h5><i data-feather="shopping-cart" class="icon-svg-primary wid-20"></i><span
                                            class="p-l-5">Bukti Pembayaran</span></h5>
                                </div>
                                <div class="card-body">
                                    {{-- Profile Member --}}
                                    <div class="text-center">
                                        <img class="img-radius img-fluid wid-150"
                                            src="{{ $transaction->member->avatar == '' ? asset('img/user.png') : url(Storage::url($transaction->member->avatar)) }}"
                                            alt="User image">
                                        <h3 class="mb-1 mt-3 f-w-400">{{ $transaction->member->name }}</h3>
                                        <p class="mb-3 text-muted">{{ $transaction->member->email }}</p>
                                    </div>
                                    <hr>

                                    @if ($transaction->status == 1)
                                        <div class="alert alert-success d-block text-center text-uppercase"><i
                                                class="feather icon-check-circle mr-2"></i>Pembayaran Diverifikasi Lunas
                                        </div>
                                    @else
                                        <div class="alert alert-warning d-block text-center text-uppercase"><i
                                                class="feather icon-check-circle mr-2"></i>Pembayaran Belum Diverifikasi
                                            Lunas</div>
                                    @endif
                                    <hr>

                                    <center>
                                        <h5 class="mb-3">Informasi Bukti Bayar</h5>
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
                                        <form method="POST"
                                            action="{{ route('dashboard.transaction.set_lunas', $transaction->id) }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <img src="{{ $transaction->payment_proof == '' ? asset('img/default.png') : url(Storage::url($transaction->payment_proof)) }}"
                                                        alt="" width="200">
                                                    <br>
                                                    <small>Bukti Pembayaran</small>
                                                </div>
                                            </div>
                                            @if ($transaction->status == 0)
                                                <button type="submit" class="btn  btn-primary"
                                                    onclick="return confirm('Apakah anda yakin?')">Set Lunas</button>
                                            @else
                                                <button type="button" class="btn  btn-success">Pembayaran Sudah
                                                    Lunas</button>
                                            @endif
                                        </form>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($transaction->status == 1 && $transaction->testimoni != '')
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Review Member</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="mb-4">
                                            <label>Rating</label>
                                            <div class="stars stars-example-fontawesome">
                                                <select id="demo-fontawesome" name="star_score" autocomplete="off" readonly
                                                    disabled>
                                                    <option value="1"
                                                        {{ $transaction->star_score == '1' ? 'selected' : '' }}>1
                                                    </option>
                                                    <option value="2"
                                                        {{ $transaction->star_score == '2' ? 'selected' : '' }}>2
                                                    </option>
                                                    <option value="3"
                                                        {{ $transaction->star_score == '3' ? 'selected' : '' }}>3
                                                    </option>
                                                    <option value="4"
                                                        {{ $transaction->star_score == '4' ? 'selected' : '' }}>4
                                                    </option>
                                                    <option value="5"
                                                        {{ $transaction->star_score == '5' ? 'selected' : '' }}>5
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-label-group">
                                            <textarea name="testimoni" id="testimoni" cols="30" rows="10"
                                                class="form-control" placeholder="Berikan Review Anda" readonly
                                                disabled>{{ $transaction->testimoni }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
@endsection

@push('js')
    <!-- Rating Js -->
    <script src="{{ asset('admin_theme') }}/assets/js/plugins/jquery.barrating.min.js"></script>
    <script src="{{ asset('admin_theme') }}/assets/js/pages/ac-rating.js"></script>
@endpush