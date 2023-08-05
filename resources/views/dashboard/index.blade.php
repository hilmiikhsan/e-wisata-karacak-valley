@extends('layouts.admin')

@section('content')
    <div class="pc-container">
        <div class="pcoded-content">
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-sm-4">
                    <div class="card bg-info text-white widget-visitor-card">
                        <div class="card-body text-center">
                            <h2 class="text-white">{{ $member }}</h2>
                            <h6 class="text-white">Member</h6>
                            <i class="feather icon-user-plus"></i>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-sm-3">
                    <div class="card bg-primary text-white widget-visitor-card">
                        <div class="card-body text-center">
                            <h2 class="text-white">{{ $kategori }}</h2>
                            <h6 class="text-white">TOTAL KATEGORI</h6>
                            <i class="feather icon-user-plus"></i>
                        </div>
                    </div>
                </div> --}}
                <div class="col-sm-4">
                    <div class="card bg-warning text-white widget-visitor-card">
                        <div class="card-body text-center">
                            <h2 class="text-white">{{ $karyawan }}</h2>
                            <h6 class="text-white">Admin</h6>
                            <i class="feather icon-user-plus"></i>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card bg-success text-white widget-visitor-card">
                        <div class="card-body text-center">
                            <h2 class="text-white">{{ $transaksi }}</h2>
                            <h6 class="text-white">Total Transaksi</h6>
                            <i class="feather icon-user-plus"></i>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card bg-warning text-white widget-visitor-card">
                        <div class="card-body text-center">
                            <h2 class="text-white">{{ $karyawan }}</h2>
                            <h6 class="text-white">Promo</h6>
                            <i class="feather icon-user-plus"></i>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card bg-success text-white widget-visitor-card">
                        <div class="card-body text-center">
                            <h2 class="text-white">{{ $transaksi }}</h2>
                            <h6 class="text-white">Artikel</h6>
                            <i class="feather icon-user-plus"></i>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card bg-success text-white widget-visitor-card">
                        <div class="card-body text-center">
                            <h2 class="text-white">{{ $transaksi }}</h2>
                            <h6 class="text-white">Laporan</h6>
                            <i class="feather icon-user-plus"></i>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-sm-6">
                    <div class="card text-center bg-success text-white">
                        <div class="card-body">
                            <i class="fas fa-paper-plane f-54 text-mute"></i>
                            <h5 class="m-b-15 m-t-15 text-white">TOTAL WISATA</h5>
                            <span class="f-18">{{ $wisata }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card text-center bg-danger text-white">
                        <div class="card-body">
                            <i class="fas fa-cube f-54 text-mute"></i>
                            <h5 class="m-b-15 m-t-15 text-white">TOTAL FASILITAS</h5>
                            <span class="f-18">{{ $fasilitas }}</span>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="row">
                <!-- [ bar-Chart ] start -->
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Statistik Pemasukan</h5>
                        </div>
                        <div class="card-body">
                            <center>
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <label>Dari</label>
                                        <input type="date" class="form-control" name="date_from" id="date_from_chart_5" max="{{ now()->subDays(1)->isoFormat('YYYY-MM-DD') }}" />
                                    </div>
                                    <div class="col-md-6">
                                        <label>Sampai</label>
                                        <input type="date" class="form-control" name="date_to" id="date_to_chart_5" value="{{ now()->isoFormat('YYYY-MM-DD') }}" max="{{ now()->isoFormat('YYYY-MM-DD') }}">
                                    </div>
                                </div>
                            </center>
                            <div id="chart_pemasukan" style="width: 100%; height: 450px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('admin_theme/assets/plugins/amchart/core.js') }}"></script>
    <script src="{{ asset('admin_theme/assets/plugins/amchart/charts.js') }}"></script>
    <script src="{{ asset('admin_theme/assets/plugins/amchart/themes/animated.js') }}"></script>

    <script>
        let chartPemasukanData;

    function loadBarKadarLaporan(data = []) {
        $.ajax({
            url: "{{ route('dashboard.statistik.get_pemasukan') }}",
            dataType: 'json',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
            success: function(response) {
                console.log(response)
                typeof chartPemasukanData === 'object' ? chartPemasukanData.dispose() : '';
                let chartKadar = am4core.create("chart_pemasukan", am4charts.PieChart);
                let title = chartKadar.titles.create();
                title.text = "Statistik Pemasukan";
                title.fontSize = 18;
                title.marginBottom = 10;

                // Legend
                chartKadar.legend = new am4charts.Legend();
                chartKadar.legend.valueLabels.template.text = "{value.value}";

                // Add data
                chartKadar.data = [
                    {
                        "status": "Pemasukan Lunas",
                        "data_count": response['pemasukan_lunas'],
                        "color": am4core.color("#B8EE7C")
                    },
                    {
                        "status": "Pemasukan Belum Lunas",
                        "data_count": response['pemasukan_belum_lunas'],
                        "color": am4core.color("#F47284")
                    }
                ];

                // Add and configure Series
                var pieSeries = chartKadar.series.push(new am4charts.PieSeries());
                pieSeries.dataFields.value = "data_count";
                pieSeries.dataFields.category = "status";
                pieSeries.slices.template.stroke = am4core.color("#fff");
                pieSeries.slices.template.strokeWidth = 2;
                pieSeries.slices.template.strokeOpacity = 1;

                // Color enable
                pieSeries.slices.template.propertyFields.fill = "color";
                pieSeries.labels.template.text = "{status}: {value.value}";

                // This creates initial animation
                pieSeries.hiddenState.properties.opacity = 1;
                pieSeries.hiddenState.properties.endAngle = -90;
                pieSeries.hiddenState.properties.startAngle = -90;

                chartKadar.padding(10,10,10,10);

                chartPemasukanData = chartKadar;
            }
        })
    }

    $("#date_from_chart_5, #date_to_chart_5").change(function() {
        chartPemasukanData.dispose();

        let data = {
            'date_from': $("#date_from_chart_5").val(),
            'date_to': $("#date_to_chart_5").val(),
            'user_id': '{{ auth()->user()->id }}'
        };

        loadBarKadarLaporan(data)
    })

    $(document).ready(function() {
        let data = {
            'user_id': '{{ auth()->user()->id }}'
        }

        loadBarKadarLaporan(data);
    });
    </script>
@endpush
