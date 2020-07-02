@extends('layouts/master')

@section('content')
<div class="bg-image" style="background-image: url('assets/img/photos/photo21@2x.jpg');">
    <div class="bg-primary-dark-op">
        <div class="content content-full content-top">
            <h1 class="py-50 text-white text-center">Pengadaan Bahan Baku</h1>
        </div>
    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <!-- Default Elements -->
            <div class="block block-rounded">
                <div class="block-content">
                    <div class="block-content">
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                            <div class="form-group row {{ $errors->has('nama') ? ' is-invalid' : '' }}">
                                    <div class="col-md-12">
                                            <label for="pengolah">Nama Rencana Produksi</label>
                                            <select class="form-control" name="bahan" id="bahan">
                                                <option value="">Pilih Rencana Produksi</option>
                                                @foreach($ramal as $d)
                                                <option value="{{ $d->id }}">{{ucfirst($d->nama_rencana)}}</option>
                                                @endforeach
                                            </select>
                                        @if ($errors->has('nama'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('nama') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row {{ $errors->has('jumlah') ? ' is-invalid' : '' }}">
                                    <div class="col-md-12">
                                            <label for="jumlah">Jumlah Produksi</label>
                                            <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah Produksi" value = "" readonly>
                                        @if ($errors->has('jumlah'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('jumlah') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row {{ $errors->has('bahan') ? ' is-invalid' : '' }}">
                                    <div class="col-md-12">
                                            <label for="pengolah">Bahan Baku</label>
                                            <select class="form-control" name="baku" id="baku" disabled>
                                                <option value="">Pilih Bahan Baku</option>
                                                @foreach($bahan as $d)
                                                <option value="{{ $d->id }}">{{ucfirst($d->nama)}}</option>
                                                @endforeach
                                            </select>
                                        @if ($errors->has('bahan'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('bahan') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row {{ $errors->has('pengadaan') ? ' is-invalid' : '' }}">
                                    <div class="col-md-12">
                                            <label for="jumlah">Jumlah Pengadaan Bahan Baku</label>
                                            <input type="text" class="form-control" id="pengadaan" name="pengadaan" placeholder="Jumlah pengadaan Bahan Baku">
                                        @if ($errors->has('pengadaan'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('pengadaan') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row {{ $errors->has('tanggal') ? ' is-invalid' : '' }}">
                                    <div class="col-md-12">
                                            <label for="tanggal">Tanggal Penagadaan Bahan Baku</label>
                                            <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="tanggal pengadaan Bahan Baku">
                                        @if ($errors->has('tanggal'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('tanggal') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row {{ $errors->has('supplier') ? ' is-invalid' : '' }}">
                                    <div class="col-md-12">
                                            <label for="pengolah">Supplier</label>
                                            <select class="form-control" name="supplier" id="supplier">
                                                <option value="">Pilih Supplier</option>
                                                @foreach($supplier as $d)
                                                <option value="{{ $d->id }}">{{ucfirst($d->nama_supplier)}}</option>
                                                @endforeach
                                            </select>
                                        @if ($errors->has('supplier'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('supplier') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row justify-content-center my-15">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-alt-primary btn-block"> Simpan</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <!-- END Default Elements -->
        </div>
    </div>
</div>
@stop
@push('scripts')
<script>
$(document).ready(function(){
  $("#bahan").change(function(){
    $.ajax({
        type: "GET",
        url: "/pengadaan/getJumlah",
        data: {
            bahan_id : $(this).val()
        },
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function(data){
            // alert(data.jumlah);
            $('#jumlah').val(data.jumlah);
            $('#baku').prop('disabled', false);
        },
        failure: function(errMsg) {
            alert(errMsg);
        }
    });
  });

  $("#baku").change(function(){
    $.ajax({
        type: "GET",
        url: "/pengadaan/getTotal",
        data: {
            bahan_id : $(this).val()
        },
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function(data){
            // alert();
            $('#pengadaan').val((Math.round(data.jumlah * $('#jumlah').val()) - data.stok ));
        },
        failure: function(errMsg) {
            alert(errMsg);
        }
    });
  });
});
</script>
@endpush
