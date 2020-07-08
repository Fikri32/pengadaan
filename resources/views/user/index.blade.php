@extends('layouts/master')

@section('content')
<div class="bg-image" style="background-image: url('assets/img/photos/photo21@2x.jpg');">
    <div class="bg-primary-dark-op">
        <div class="content content-full content-top">
            <h1 class="py-50 text-white text-center">Kelola Pengguna</h1>
        </div>
    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="block block-themed">
                <div class="block-content bg-body-light">
                    <!-- Search -->
                    <form action="" method="get" >
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
                                <th class="d-none d-sm-table-cell">Nama</th>
                                <th class="d-none d-sm-table-cell">Role</th>
                                <th class="d-none d-sm-table-cell">Email</th>
                                <th class="d-none d-sm-table-cell">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no = 0;?>
                        @foreach ($user as $d)
                        <?php $no++ ;?>
                            <tr class="text-center" data-href="">
                                <input type="hidden" class = "hapus_data" value = "{{$d->id}}">
                                <td>{{$no}}</td>
                                <td>{{$d->name}}</td>
                                <td>{{$d->roles[0]->name}}</td>
                                <td>
                                  {{$d->email}}
                                </td>
                                <td>
                                <a class="btn btn-rounded btn-alt-secondary mr-10 p" href="{{ url('pengguna/update/'.$d->id) }}">
                                    <i class="si si-note mx-5"></i>
                                    <span class="d-none d-sm-inline"> Edit Pengguna</span>
                                </a>
                                <a class="btn btn-rounded btn-alt-danger mr-10 Hapus" href="">
                                    <i class="si si-trash mx-5"></i>
                                    <span class="d-none d-sm-inline"> Hapus Pengguna</span>
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
            title: "Apakah Anda Yakin?",
            text: "Data Pengguna Tidak Akan Bisa Di Kembalikan Jika Di Hapus",
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
                    url:  '/pengguna/delete/'+delete_id,
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
