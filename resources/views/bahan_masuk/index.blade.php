@extends('layouts/master')

@section('content')
<div class="bg-image" style="background-image: url('assets/img/photos/photo21@2x.jpg');">
    <div class="bg-primary-dark-op">
        <div class="content content-full content-top">
            <h1 class="py-50 text-white text-center">Kelola Stok Bahan Baku Masuk</h1>
        </div>
    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="block block-rounded">
                <div class="block-content bg-body-light">
                    <!-- Search -->
                    <form action="{{route('masuk.cari')}}" method="get">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">List Stok Bahan Baku Masuk</h3>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" id = "cari"  name="cari" placeholder="Cari data Bahan Baku">
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
                                <th class="d-none d-sm-table-cell">Supplier</th>
                                <th class="d-none d-sm-table-cell">Tanggal Masuk</th>
                                <th class="d-none d-sm-table-cell">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                        <?php $no = 0;?>
                        @foreach ($baku_data as $d)
                        <?php $no++ ;?>

                            <tr class = "text-center" data-href="">
                            <input type="hidden" class = "hapus_data" value = "{{$d->id}}">
                            <td>{{$no}}</td>
                                <td>{{$d->bahanbaku->nama}}</td>

                                <td>
                                  {{$d->jumlah}}
                                </td>
                                <td class="d-none d-sm-table-cell">
                                <em class="text-muted">{{$d->bahanbaku->satuan}}</em>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                <em class="text-muted">{{$d->supplier->nama_supplier}}</em>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                {{Carbon\Carbon::parse($d->tgl_masuk)->translatedFormat('d F Y')}}
                                </td>
                                <td>
                                <a class="btn btn-rounded btn-alt-secondary mr-10 p" href="{{ url('bahanmasuk/edit/'.$d->id) }}">
                                    <i class="si si-note mx-5"></i>
                                    <span class="d-none d-sm-inline"> Edit Bahan Baku</span>
                                </a>
                                <a class="btn btn-rounded btn-alt-danger mr-10 Hapus" href="{{ url('bahanmasuk/delete/'.$d->id) }}">
                                    <i class="si si-trash mx-5"></i>
                                    <span class="d-none d-sm-inline"> Hapus Bahan Baku</span>
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
    $(document).ready(function (){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.Hapus').click(function (e){
            e.preventDefault();
            var delete_id = $(this).closest('tr').find('.hapus_data').val();
            // alert(delete_id);
    swal({
        title: "Apakah Anda Yakin?",
        text: "Data Bahan Baku Masuk Tidak Akan Bisa Di Kembalikan Jika Di Hapus",
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
                    url:  '/bahanmasuk/delete/'+delete_id,
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
