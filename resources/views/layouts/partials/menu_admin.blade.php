<ul class="pc-navbar">
    <li class="pc-item pc-caption">
        <label>Menu</label>
    </li>
    <li class="pc-item"><a href="{{ route('dashboard') }}" class="pc-link "><span class="pc-micon"><i
                    data-feather="layout"></i></span><span class="pc-mtext">Dashboard</span></a></li>

    <li class="pc-item pc-caption">
        <label>Master Data</label>
    </li>
    {{-- <li class="pc-item"><a href="{{ route('dashboard.berita.index') }}" class="pc-link "><span class="pc-micon"><i
                    data-feather="book"></i></span><span class="pc-mtext">Berita</span></a></li> --}}
    <li class="pc-item pc-hasmenu">
        <a href="javascript:void(0)" class="pc-link"><span class="pc-micon"><i data-feather="user"></i></span><span
                class="pc-mtext">User Akun</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
        <ul class="pc-submenu">
            <li class="pc-item"><a class="pc-link" href="{{ route('dashboard.akun_admin') }}">Akun Admin</a>
            </li>
            <li class="pc-item"><a class="pc-link" href="{{ route('dashboard.akun_member') }}">Akun Member</a></li>
        </ul>
    </li>
    {{-- <li class="pc-item"><a href="{{ route('dashboard.kategori.index') }}" class="pc-link "><span class="pc-micon"><i
                    data-feather="life-buoy"></i></span><span class="pc-mtext">Kategori</span></a></li>
    <li class="pc-item"><a href="{{ route('dashboard.fasilitas.index') }}" class="pc-link "><span class="pc-micon"><i
                    data-feather="layers"></i></span><span class="pc-mtext">Fasilitas BACKUP</span></a></li> --}}
    <li class="pc-item"><a href="{{ route('dashboard.fasilitas_wisata.index') }}" class="pc-link "><span class="pc-micon"><i
        data-feather="layers"></i></span><span class="pc-mtext">Fasilitas</span></a></li>
    <li class="pc-item"><a href="{{ route('dashboard.promotion.index') }}" class="pc-link "><span class="pc-micon"><i
        data-feather="shopping-cart"></i></span><span class="pc-mtext">Promosi</span></a></li>
    <li class="pc-item"><a href="{{ route('dashboard.berita.index') }}" class="pc-link "><span class="pc-micon"><i
        data-feather="book"></i></span><span class="pc-mtext">Blog</span></a></li>
    <li class="pc-item"><a href="{{ route('dashboard.gallery.index') }}" class="pc-link "><span class="pc-micon"><i
        data-feather="book"></i></span><span class="pc-mtext">Gallery</span></a></li>
    {{-- <li class="pc-item"><a href="{{ route('dashboard.wisata.index') }}" class="pc-link "><span class="pc-micon"><i
                    data-feather="home"></i></span><span class="pc-mtext">Wisata</span></a></li> --}}


    <li class="pc-item pc-caption">
        <label>Transaksi</label>
    </li>
    <li class="pc-item"><a href="{{ route('dashboard.payment_method.index') }}" class="pc-link "><span class="pc-micon"><i
        data-feather="shopping-cart"></i></span><span class="pc-mtext">Metode Pembayaran</span></a></li>
    <li class="pc-item"><a href="{{ route('dashboard.pemesanan') }}" class="pc-link "><span class="pc-micon"><i
                    data-feather="shopping-cart"></i></span><span class="pc-mtext">Pemesanan</span></a></li>

    <li class="pc-item pc-caption">
        <label>Laporan</label>
    </li>
    <li class="pc-item"><a href="{{ route('dashboard.contact_form.index') }}" class="pc-link "><span class="pc-micon"><i
                    data-feather="pie-chart"></i></span><span class="pc-mtext">Inbox / Contact us</span></a></li>
    <li class="pc-item"><a href="{{ route('dashboard.laporan.pemasukan') }}" class="pc-link "><span class="pc-micon"><i
                    data-feather="pie-chart"></i></span><span class="pc-mtext">Laporan Pemasukan</span></a></li>
</ul>
