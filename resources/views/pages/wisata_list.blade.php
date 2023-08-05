@extends('layouts.front')

@section('content')
<div class="bradcam_area" style="background-image: url('{{ asset('img/bg-about.png') }}')">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text text-center">
                    <h3>List Wisata</h3>
                    <p>{{ config('app.name') }} adalah aplikasi berbasis web yang menyediakan informasi tempat-tempat wisata sekaligus tersedia fitur pemesanan sehingga memudahkan pengunjung.</p>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="popular_places_area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section_title text-center mb_70">
                        <h3>Wisata Populer</h3>
                        <p>Nah, buat kamu yang bingung akhir pekan mau ke mana, Berikut ini ada beberapa tempat wisata di
                            Dili terbaru yang lagi hits dan wajib untuk kamu kunjungi!.</p>

                        @if (isset($keyword))
                            <p class="mt-3">Kata Pencarian: <b>{{ $keyword }}</b></p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($wisatas as $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="single_place">
                            <div class="thumb">
                                <img src="{{ ($item->thumbnail == '') ? asset('img/default.png') : url(Storage::url($item->thumbnail)) }}" alt="">
                                <a href="{{ route('wisata.detail', $item->slug) }}" class="prise">Rp {{ number_format($item->price, 0, ",", ".") }}</a>
                            </div>
                            <div class="place_info">
                            <a href="{{ route('wisata.detail', $item->slug) }}">
                                    <h3>{{ $item->wisata }}</h3>
                                </a>
                                <p>{!! Str::limit($item->desc, 50) !!}</p>
                                <div class="rating_days d-flex justify-content-between">
                                    <span class="d-flex justify-content-center align-items-center">
                                        @php
                                        // Akumulasi star score dari setiap review
                                        $transactions = $item->transaksi->where('testimoni', '!=', '')->where('status', 1);
                                        $scores = 0;
                                        foreach($transactions as $trans) {
                                            $scores += $trans->star_score;
                                        }
                                        $accumulated = round((($scores == 0) ? 1 : $scores) / (($transactions->count() == 0) ? 1 : $transactions->count()));
                                        @endphp

                                        @for ($i = 0; $i < $accumulated; $i++)
                                            <i class="fa fa-star"></i>
                                        @endfor
                                        <a href="#">({{ $transactions->count() }} Review)</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
