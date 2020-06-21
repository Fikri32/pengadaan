@role('kepala bahan baku')
<div class="content-side content-side-full">
    <ul class="nav-main">
        <li>
            <a class="{{ Request::is('home') ? 'active' : null }}" href="{{ route('home') }}" class=""><i class="fa fa-dashboard"></i><span class="sidebar-mini-hide">Beranda</span></a>
        </li>
        <li >
            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-shopping-cart mr-5"></i>Pengadaan Bahan Baku</a>
            <ul>
                <li>
                    <a href="{{ route('pengadaan.tambah')}}" class="">Tambah Pengadaan Bahan Baku</a>
                </li>
                <li>
                    <a href="{{ route('pengadaan.index')}}" class="">Kelola Pengadaan Bahan Baku</a>
                </li>
            </ul>
        </li>
        <li >
        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-cubes mr-5"></i>Bahan Baku</a>
            <ul>
                <li>
                    <a href="{{ route('bahanbaku.tambah')}}" class="">Tambah Bahan Baku</a>
                </li>
                <li>
                    <a href="{{ route('bahanbaku.index')}}"  class="">Kelola Bahan Baku</a>
                </li>
            </ul>
        </li>
        <li >
        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-login mr-5"></i>Bahan Baku Masuk</a>
            <ul>
                <li>
                    <a href="{{ route('laporan.masuk')}}"  class="">Bahan Baku Masuk</a>
                </li>
            </ul>
        </li>
        <li >
        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-logout mr-5"></i>Bahan Baku Keluar</a>
            <ul>
                <li>
                    <a href="{{ route('laporan.keluar')}}" class="">Bahan Baku Keluar</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-truck mr-5"></i>Supplier</a>
            <ul>
                <li>
                    <a href="{{ route('supplier.tambah')}}" class="">Tambah Supplier</a>
                </li>
                <li>
                    <a href="{{ route('supplier.index')}}" class="">Kelola Supplier</a>
                </li>
            </ul>
        </li>


    </ul>
</div>
@endrole
@role('kepala produksi')
<div class="content-side content-side-full">
    <ul class="nav-main">
        <li>
            <a class="{{ Request::is('home') ? 'active' : null }}" href="{{ route('home') }}" class=""><i class="si si-compass"></i><span class="sidebar-mini-hide">Beranda</span></a>
        </li>
        <li>
            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-industry mr-5"></i>Produk</a>
            <ul>
                <li>
                    <a href="{{ route('produk.tambah')}}" class="">Tambah Data Produk</a>
                </li>
                <li>
                    <a href="{{ route('produk.index')}}" class="">Kelola Produk</a>
                </li>

            </ul>
        </li>
        <li>
            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-dollar mr-5"></i>Penjualan</a>
            <ul>
                <li>
                    <a href="{{ route('penjualan.tambah')}}" class="">Tambah Data Penjualan</a>
                </li>
                <li>
                    <a href="{{ route('penjualan.index')}}" class="">Kelola Penjualan</a>
                </li>

            </ul>
        </li>
        <li>
            <a class="" href="{{ route('peramalan') }}" class=""><i class="fa fa-bar-chart"></i><span class="sidebar-mini-hide">Peramalan</span></a>
        </li>
    </ul>
</div>
@endrole
@role('manager umum')
<div class="content-side content-side-full">
    <ul class="nav-main">
        <li>
            <a class="{{ Request::is('home') ? 'active' : null }}" href="{{ route('home') }}" class=""><i class="si si-compass"></i><span class="sidebar-mini-hide">Beranda</span></a>
        </li>
        <li>
            <a class="" href="" class=""><i class="fa fa-dollar mr-5"></i><span class="sidebar-mini-hide">Laporan Penjualan</span></a>
        </li>
        <li>
            <a class="" href="" class=""><i class="fa fa-industry mr-5"></i><span class="sidebar-mini-hide">Laporan produksi</span></a>
        </li>
        <li>
            <a class="" href="" class=""><i class="fa fa-cubes mr-5"></i><span class="sidebar-mini-hide">Laporan Bahan Baku</span></a>
        </li>
    </ul>
</div>
@endrole

@role('staff gudang')
<div class="content-side content-side-full">
    <ul class="nav-main">
        <li>
            <a class="{{ Request::is('home') ? 'active' : null }}" href="{{ route('home') }}" class=""><i class="si si-compass"></i><span class="sidebar-mini-hide">Beranda</span></a>
        </li>
        <li>
        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-login mr-5"></i>Bahan Baku Masuk</a>
            <ul>
                <li>
                    <a href="{{ route('masuk.tambah')}}" class="">Tambah Bahan Baku Masuk</a>
                </li>
                <li>
                    <a href="{{ route('masuk.index')}}"  class="">Kelola Bahan Baku Masuk</a>
                </li>
            </ul>
        </li>
        <li>
        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-logout mr-5"></i>Bahan Baku Keluar</a>
            <ul>
                <li>
                    <a href="{{ route('keluar.tambah')}}" class="">Tambah Bahan Baku Keluar</a>
                </li>
                <li>
                    <a href="{{ route('keluar.index')}}" class="">Kelola Bahan Baku Keluar</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="" href="{{ route('bahanbaku.index')}}"  class=""><i class="fa fa-cubes mr-5"></i><span class="sidebar-mini-hide">Stok Bahan Baku</span></a>
        </li>
    </ul>
</div>
@endrole


