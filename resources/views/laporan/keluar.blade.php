@extends('layouts/master')

@section('content')
<div class="bg-image" style="background-image: url('assets/img/photos/photo21@2x.jpg');">
    <div class="bg-primary-dark-op">
        <div class="content content-full content-top">
            <h1 class="py-50 text-white text-center">Laporan Bahan Baku Keluar</h1>
        </div>
    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="block block-rounded">
                <div class="block-content bg-body-light">
                    <!-- Search -->
                    <form action="{{route('laporan_keluar.cari')}}" method="get">
                        <div class="block-header block-header-default">
                            <h3 class="block-title"></h3>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" id ="cari" name="cari" placeholder="Cari data Bahan Baku">
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
                                <th class="d-none d-sm-table-cell">Bahan Baku</th>
                                <th class="d-none d-sm-table-cell">Jumlah</th>
                                <th class="d-none d-sm-table-cell">Satuan</th>
                                <th class="d-none d-sm-table-cell">Tanggal Keluar</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no = 0;?>
                        @foreach ($baku_data as $d)
                        <?php $no++ ;?>
                            <tr class = "text-center" >
                                <td>{{$no}}</td>
                                <td>{{$d->bahanbaku->nama}}</td>

                                <td>
                                  {{$d->jumlah}}
                                </td>
                                <td class="d-none d-sm-table-cell">
                                <em class="text-muted"> {{$d->bahanbaku->satuan}}</em>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                <em class="text-muted">{{ date("d-m-Y", strtotime($d->tgl_keluar))}}</em>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
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
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
    });
</script>
@endpush
