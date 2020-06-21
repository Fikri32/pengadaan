@extends('layouts/master')

@section('content')
<div class="bg-image" style="background-image: url('assets/img/photos/photo21@2x.jpg');">
    <div class="bg-primary-dark-op">
        <div class="content content-full content-top">
            <h1 class="py-50 text-white text-center">Kelola Produk</h1>
        </div>
    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="block block-themed">
                <div class="block-content bg-body-light">
                    <!-- Search -->
                    <form action="be_pages_ecom_products.html" method="post" onsubmit="return false;">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Produk</h3>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Cari data produk">
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
                                <th class="d-none d-sm-table-cell">Produk</th>
                                <th class="d-none d-sm-table-cell">Stok</th>
                                <th class="d-none d-sm-table-cell">Komposisi</th>
                                <th class="d-none d-sm-table-cell">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                        <?php $no = 0;?>
                        @foreach ($produk_data as $d)
                        <?php $no++ ;?>
                            <tr class="clickable-row" data-href="">
                                <input type="hidden" class = "hapus_data" value = "{{$d->id}}">
                                <td>{{$no}}</td>
                                <td>{{$d->nama}}</td>

                                <td>
                                  {{$d->stok}}
                                </td>
                                <td>
                                <a class="btn btn-rounded btn-alt-secondary mr-10 p" href="{{ url('komposisi/index/'.$d->id) }}">
                                    <i class="si si-note mx-5"></i>
                                    <span class="d-none d-sm-inline"> Komposisi Produk</span>
                                </a>
                                </td>
                                <td>
                                <a class="btn btn-rounded btn-alt-secondary mr-10 p" href="{{ url('produk/edit/'.$d->id) }}">
                                    <i class="si si-note mx-5"></i>
                                    <span class="d-none d-sm-inline"> Edit Produk</span>
                                </a>
                                <a class="btn btn-rounded btn-alt-danger mr-10 Hapus" href="">
                                    <i class="si si-trash mx-5"></i>
                                    <span class="d-none d-sm-inline"> Hapus Produk</span>
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
<script>
    $(document).ready(function (){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.Hapus').click(function (e){
            e.preventDefault();
            var delete_id = $(this).closest('tr').find('.hapus_data').val();

    swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
        .then((willDelete) => {
            if (willDelete) {

                    var data = {
                        "_token" : $('input[name=_token]').val(),
                        "id" : delete_id,
                    };

                $.ajax({
                    type: "DELETE",
                    url:  '/produk/delete/'+delete_id,
                    data : data,

                    success: function (response){
                        swal(response.status, {
                            icon: "success",
                        })
                        .then((result) => {
                            location.reload();
                        });
                    }
                });

            }
        });
    });
});

</script>
@endpush
