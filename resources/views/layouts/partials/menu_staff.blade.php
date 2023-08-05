<ul class="pc-navbar">
    <li class="pc-item pc-caption">
        <label>Menu</label>
    </li>
    <li class="pc-item"><a href="{{ route('dashboard') }}" class="pc-link "><span class="pc-micon"><i
                    data-feather="layout"></i></span><span class="pc-mtext">Dashboard</span></a></li>

    <li class="pc-item pc-caption">
        <label>Master Data</label>
    </li>
    <li class="pc-item"><a href="{{ route('dashboard.berita.index') }}" class="pc-link "><span class="pc-micon"><i
        data-feather="book"></i></span><span class="pc-mtext">Berita</span></a></li>
    <li class="pc-item"><a href="{{ route('dashboard.kategori.index') }}" class="pc-link "><span class="pc-micon"><i
                    data-feather="life-buoy"></i></span><span class="pc-mtext">Kategori</span></a></li>
    <li class="pc-item"><a href="{{ route('dashboard.fasilitas.index') }}" class="pc-link "><span class="pc-micon"><i
                    data-feather="layers"></i></span><span class="pc-mtext">Fasilitas</span></a></li>
    <li class="pc-item"><a href="{{ route('dashboard.wisata.index') }}" class="pc-link "><span class="pc-micon"><i
                    data-feather="home"></i></span><span class="pc-mtext">Wisata</span></a></li>


    <li class="pc-item pc-caption">
        <label>Transaksi</label>
    </li>
    <li class="pc-item"><a href="{{ route('dashboard.pemesanan') }}" class="pc-link "><span class="pc-micon"><i
                    data-feather="shopping-cart"></i></span><span class="pc-mtext">Pemesanan</span></a></li>

</ul>
