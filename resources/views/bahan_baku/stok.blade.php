@extends('layouts/master')

@section('content')
<div class="bg-image" style="background-image: url('assets/img/photos/photo21@2x.jpg');">
    <div class="bg-primary-dark-op">
        <div class="content content-full content-top">
            <h1 class="py-50 text-white text-center">Kelola Stok Bahan Baku</h1>
        </div>
    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="block block-rounded">
                <div class="block-content bg-body-light">
                    <!-- Search -->
                    <form action="be_pages_ecom_products.html" method="post" onsubmit="return false;">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">List Stok Bahan Baku</h3>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Cari data Bahan Baku">
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
                            <tr>
                                <th style="width: 100px;">No</th>
                                <th class="d-none d-sm-table-cell">Bahan Baku</th>
                                <th class="d-none d-sm-table-cell">Jumlah</th>
                                <th class="d-none d-sm-table-cell">Satuan</th>
                                <th class="d-none d-sm-table-cell">Action</th>

                            </tr>
                        </thead>
                        <tbody>

                        <?php $no = 0;?>
                        @foreach ($baku_data as $d)
                        <?php $no++ ;?>
                            <tr >
                                <td>{{$no}}</td>
                                <td>{{$d->nama}}</td>

                                <td>
                                  {{$d->stok}}
                                </td>
                                <td class="d-none d-sm-table-cell">
                                <em class="text-muted">{{$d->satuan}}</em>
                                </td>
                                <td>
                                <a class="btn btn-rounded btn-alt-secondary mr-10 p" href="{{ url('bahanbaku/edit/'.$d->id) }}">
                                    <i class="si si-note mx-5"></i>
                                    <span class="d-none d-sm-inline"> Edit Bahan Baku</span>
                                </a>
                                <a class="btn btn-rounded btn-alt-danger mr-10" href="{{ url('bahanbaku/delete/'.$d->id) }}">
                                    <i class="si si-trash mx-5"></i>
                                    <span class="d-none d-sm-inline"> Hapus Bahan Baku</span>
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
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
    });
</script>
@endpush
