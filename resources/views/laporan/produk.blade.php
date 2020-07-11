@extends('layouts/master')

@section('content')
<div class="bg-image" style="background-image: url('assets/img/photos/photo21@2x.jpg');">
    <div class="bg-primary-dark-op">
        <div class="content content-full content-top">
            <h1 class="py-50 text-white text-center">Laporan Produk</h1>
        </div>
    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="block block-themed">
                <div class="block-content bg-body-light">
                    <!-- Search -->
                    <form action="{{route('produk.cari')}}" method="get" >
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Produk</h3>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="cari" name="cari" placeholder="Cari data produk">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-secondary">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END Search -->
                </div>
                <div class="block-content">
                    <!-- Products Table -->

                    <table class="js-table-checkable table table-hover js-table-checkable-enabled">
                        <thead>
                            <tr class = "text-center">
                                <th style="width: 100px;">No</th>
                                <th class="d-none d-sm-table-cell">Produk</th>
                                <th class="d-none d-sm-table-cell">Harga</th>
                                <th class="d-none d-sm-table-cell">Stok</th>
                                <th class="d-none d-sm-table-cell">Komposisi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no = 0;?>
                        @foreach ($produk as $d)
                        <?php $no++ ;?>
                            <tr class="text-center" data-href="">
                                <input type="hidden" class = "hapus_data" value = "{{$d->id}}">
                                <td>{{$no}}</td>
                                <td>{{$d->nama}}</td>
                                <td>Rp {{number_format($d->harga)}} / ton</td>
                                <td>
                                  {{$d->stok}}
                                </td>
                                <td>
                                <a class="btn btn-rounded btn-alt-secondary mr-10 p" href="{{ url('komposisi/index/'.$d->id) }}">
                                    <i class="si si-note mx-5"></i>
                                    <span class="d-none d-sm-inline"> Komposisi Produk</span>
                                </a>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- END Products Table -->

                    <!-- Navigation -->

                    <!-- END Navigation -->

                </div>
            </div>
            <!-- END Default Elements -->
        </div>
    </div>
</div>
@stop

@push('scripts')

@endpush
