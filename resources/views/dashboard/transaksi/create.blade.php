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
                            <form method="POST" action="{{ route('booking', 2) }}">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Kategori Usia</label>
                                        <select class="form-control" name="category_age" id="category_age">
                                            <option value="Dewasa">Dewasa</option>
                                            <option value="Anak-anak">Anak-anak</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Harga Tiket Perorang</label>
                                        <select class="form-control" name="grand_total" id="grand_total" disabled>
                                            <option value="15000">Rp. 15,000</option>
                                            <option value="10000">Rp. 10,000</option>
                                            <option value="5000">Rp. 5,000</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Kunjungan</label>
                                        <select class="form-control" name="visited" id="visited">
                                            <option value="Camping">Camping</option>
                                            <option value="Liburan">Liburan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Jumlah Orang</label>
                                        <input type="number" name="people_count" min="1" max="50" placeholder="Berapa Orang?" value="1" class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Tanggal Datang</label>
                                        <input type="date" class="form-control" name="check_in" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Berapa Hari</label>
                                        <input type="number" name="days" min="1" max="7" placeholder="Berapa Hari?" value="1" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Data Pembayaran</label>
                                        <select class="form-control" name="payment_method" id="payment_method">
                                            @foreach($paymentMethods as $method)
                                                <option value="{{ $method->payment_method }}">{{ $method->payment_method }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Atas Nama</label>
                                        <input type="text" name="account_name" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Nomor</label>
                                        <input type="number" name="account_number" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <!-- Form Pesan -->
                                    <div class="col-md-12">
                                        <textarea name="message" id="message" cols="30" rows="10" placeholder="Pesan/Catatan" class="form-control"></textarea>
                                    </div>
                                </div>
                                {{-- <div class="form-row">
                                    <!-- Tombol Pesan -->
                                    <div class="col-md-12">
                                        <div class="submit_btn">
                                            <button class="boxed-btn4" type="submit" style="width: 100%;">Pesan</button>
                                        </div>
                                    </div>
                                </div> --}}
                                <button type="submit" class="form-control btn btn-primary">Pesan Tiket</button>
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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const categoryAgeSelect = document.getElementById("category_age");
        const hargaTiketSelect = document.getElementById("grand_total");
        const kunjunganSelect = document.getElementById("visited");
        let grandTotalElement = document.getElementById('grand_total');

        categoryAgeSelect.addEventListener("change", updateHargaTiket);
        kunjunganSelect.addEventListener("change", updateHargaTiket);
        grandTotalElement.value = <?php echo $grandTotal ?? ''; ?>

        function updateHargaTiket() {
            const categoryAge = categoryAgeSelect.value;
            const kunjungan = kunjunganSelect.value;

            if (categoryAge === "Dewasa" && kunjungan === "Liburan") {
                hargaTiketSelect.value = "10000";
            } else if (categoryAge === "Anak-anak" && kunjungan === "Liburan") {
                hargaTiketSelect.value = "5000";
            } else if (kunjungan === "Camping") {
                hargaTiketSelect.value = "15000";
            } else {
                hargaTiketSelect.value = "";
            }
        }
    });
</script>
    <!-- CKEditor -->
    <script src="{{ asset('admin_theme') }}/assets/plugins/ckeditor/ckeditor.js"></script>
@endpush
