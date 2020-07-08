@extends('layouts/master')

@section('content')
<div class="bg-image" style="background-image: url('assets/img/photos/photo21@2x.jpg');">
    <div class="bg-primary-dark-op">
        <div class="content content-full content-top">
            <h1 class="py-50 text-white text-center">Peramalan Penjualan</h1>
        </div>
    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <!-- Default Elements -->
            <div class="block block-rounded">
                <div class="block-content">

                    <form action="{{ route('peramalan') }}" method="get">
                    @csrf
                        <div class="row">
                        <div class="col-md-6 col-xl-3">
                            <div class="form-group row {{ $errors->has('produk') ? ' is-invalid' : '' }}">
                                    <label class="col-lg-4 col-form-label" >Produk</label>
                                    <div class="col-lg-8">
                                        <select class="form-control" name="produk" id="produk">
                                            <option value="">Pilih Produk</option>
                                            @foreach($produk as $d)
                                            <option value="{{ $d->id }}">{{ ucfirst($d->nama) }}</option>
                                            @endforeach
                                        </select>
                                    @if ($errors->has('produk'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('produk') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" >Dari</label>
                                    <div class="col-lg-8">
                                        <input type="month" class="form-control" id="from" name="from" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="Dari Tanggal">
                                        <div class="form-text text-danger"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" >Sampai</label>
                                    <div class="col-lg-8">
                                        <input type="month" class="form-control" id="to" name="to" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="Sampai Tanggal">
                                        <div class="form-text text-danger"></div>
                                    </div>
                                </div>
                            </div>
                           <br>
                            <div class="col-md-6 col-xl-3" >
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <button type="submit" class="btn btn-primary btn-lg mr-0 ml-auto btn-block">Ramal</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>

                    <div class="block-content">

                    <!-- Products Table -->
                    <table class="table table-bordered table-striped table-hover">

                    <form action="{{ route('peramalan') }}" method="post">
                        @csrf
                            <div class="form-group row {{ $errors->has('nama') ? ' is-invalid' : '' }}">
                                <div class="col-md-5">
                                        <label for="nama">Nama Rencana Produksi</label>
                                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama Rencana Produksi">
                                    @if ($errors->has('nama'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('nama') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row {{ $errors->has('produk') ? ' is-invalid' : '' }}">
                                <div class="col-md-5">
                                        <input type="hidden" class="form-control" id="produk_id" name="produk_id"  placeholder="Masukan Nama Rencana Produksi" value= "{{$produk_id}}">
                                    @if ($errors->has('produk'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('produk') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        <thead>
                            <tr>
                                <th style="vertical-align:middle;" class="text-center">
                                    Bulan
                                </th>
                                <th style="vertical-align:middle;" class="text-center">
                                    Penjualan <i></i>
                                </th>

                            </tr>
                        </thead>
                        @for($i = 0; $i < count($data['array']); $i++)
                        <tbody>


                            <tr>

                                <td>

                                    {{ $data['periode'][$i] }}

                                </td>

                                <td>
                                    {{ $data['array'][$i] }}
                                </td>


                            </tr>

                        @endfor
                        </tbody>

                        <tfoot>
                        <td><b>Hasil Peramalan</b></td>

                        <td >
                        <div class="form-group row {{ $errors->has('jumlah') ? ' is-invalid' : '' }}">
                                <div class="col-md-12">
                                        <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Masukan Nama Rencana Produksi" value = "{{$produksi}}">
                                    @if ($errors->has('jumlah'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('jumlah') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            Simpan
                                        </button>

                                    </div>
                                </div>

                        </td>



                        </tfoot>

                    </table>


                    <!-- END Products Table -->
                </form>

                </div>
            </div>
            <!-- END Default Elements -->
        </div>
    </div>
</div>
@endsection
