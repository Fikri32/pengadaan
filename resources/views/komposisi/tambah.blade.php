@extends('layouts/master')

@section('content')
<div class="bg-image" style="background-image: url('assets/img/photos/photo21@2x.jpg');">
    <div class="bg-primary-dark-op">
        <div class="content content-full content-top">
            <h1 class="py-50 text-white text-center">Komposisi Produk</h1>
        </div>
    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="block block-themed">
                <div class="block-content bg-body-light">
                    <!-- Search -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Tambah Komposisi
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <form action="{{route('komposisi.tambah')}}" method="post" class="form-horizontal">
                                            @csrf
                                                <div  class="form-group row">
                                                    <label class="col-md-2">Nama Produk</label>
                                                    <div class="col-md-5">
                                                        <select class="form-control" name="produk" id="produk">
                                                            @foreach($produk as $d)
                                                            <option value="{{ $d->id }}">{{ ucfirst($d->nama) }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2">Bahan Baku</label>
                                                        <div class="col-md-5">
                                                            <select class="form-control" name="bahan" id="bahan">
                                                                <option value="">Pilih Bahan Baku</option>
                                                                    @foreach($bahan as $d)
                                                                    <option value="{{ $d->id }}">{{ ucfirst($d->nama) }}</option>
                                                                    @endforeach
                                                            </select>
                                                        </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2">Jumlah Komposisi</label>
                                                    <div class="col-md-5">
                                                        <input type="number" name="jumlah" id = "jumlah" placeholder="Masukkan Jumlah Komposisi" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-sm btn-primary">
                                                            Simpan
                                                        </button>
                                                        <a href="{{url('produk/index')}}" title="" class="btn btn-sm btn-secondary">
                                                            Kembali Ke Daftar Produk
                                                        </a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="block-content">
                    <!-- Products Table -->

                    <table class="js-table-checkable table table-hover js-table-checkable-enabled">
                        <thead>
                            <tr>
                                <th style="width: 100px;">No</th>
                                <th class="d-none d-sm-table-cell">Produk</th>
                                <th class="d-none d-sm-table-cell">Komposisi</th>
                                <th class="d-none d-sm-table-cell">Jumlah</th>
                                <th class="d-none d-sm-table-cell">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                          @foreach($komposisi as $d)
                            <tr class="clickable-row" data-href="">
                                <td></td>
                                <td>{{$d->produk->nama}}</td>

                                <td>
                                    {{$d->bahanbaku->nama}}
                                </td>
                                <td>{{$d->jumlah}}</td>
                                <td>
                                <a class="btn btn-rounded btn-alt-secondary mr-10 p" href="{{ url('komposisi/edit/'.$d->id) }}">
                                    <i class="si si-note mx-5"></i>
                                    <span class="d-none d-sm-inline"> Edit Komposisi</span>
                                </a>
                                <a class="btn btn-rounded btn-alt-danger mr-10" href="{{url('komposisi/delete/'.$d->id)}}">
                                    <i class="si si-trash mx-5"></i>
                                    <span class="d-none d-sm-inline"> Hapus Komposisi</span>
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
