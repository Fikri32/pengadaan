@extends('layouts/master')

@section('content')
<div class="bg-image" style="background-image: url('assets/img/photos/photo21@2x.jpg');">
    <div class="bg-primary-dark-op">
        <div class="content content-full content-top">
            <h1 class="py-50 text-white text-center">Kelola Supplier</h1>
        </div>
    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            Supplier ({{ $total_supplier }})
            <div class="block block-rounded">
                <div class="block-content bg-body-light">
                    <!-- Search -->
                    <form action="be_pages_ecom_products.html" method="post" onsubmit="return false;">
                    <div class="block-header block-header-default">
                            <h3 class="block-title">List Supplier</h3>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Cari data Supplier">
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
                                <th class="d-none d-sm-table-cell">Nama Supplier</th>
                                <th class="d-none d-sm-table-cell">Alamat</th>
                                <th class="d-none d-sm-table-cell">Email</th>
                                <th style="width: 100px;" class="d-none d-sm-table-cell">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($supplier_data as $d)
                            <tr class="clickable-row" data-href="">
                                <td>{{$d->id}}</td>
                                <td>{{$d->nama_supplier}}</td>
                                <td>{{$d->Alamat}}</td>

                                <td>{{$d->email}}</td>
                                <td>

                                <a class="btn btn-rounded btn-alt-secondary mr-10 p" href="{{ url('supplier/edit/'.$d->id) }}">
                                    <i class="si si-note mx-5"></i>
                                    <span class="d-none d-sm-inline"> Edit Supplier</span>
                                </a>
                                <a class="btn btn-rounded btn-alt-danger mr-10" href="{{ url('supplier/delete/'.$d->id) }}">
                                    <i class="si si-trash mx-5"></i>
                                    <span class="d-none d-sm-inline"> Hapus Supplier</span>
                                </a>

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
