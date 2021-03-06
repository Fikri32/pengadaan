@extends('layouts.master')

@section('content')
<div class="bg-image" style="background-image: url('assets/img/photos/photo21@2x.jpg');">
    <div class="bg-primary-dark-op">
        <div class="content content-full content-top">
            <h1 class="py-50 text-white text-center">Tambah Produk Masuk</h1>
        </div>
    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <!-- Default Elements -->
            <div class="block block-rounded">
                <div class="block-content">
                    <form action="{{ route('produkmasuk.tambah') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group row {{ $errors->has('produk') ? ' is-invalid' : '' }}">
                                    <div class="col-md-12">
                                            <label for="pengolah">Produk</label>
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
                                <div class="form-group row {{ $errors->has('bulan') ? ' is-invalid' : '' }}">
                                    <div class="col-md-12">
                                            <label label for="tanggal">Bulan</label>
                                            <input type="month" class="form-control" id="tanggal" name="tanggal" placeholder="Masukan Bulan Produk Masuk" data-date-format="dd-mm-yyyy" data-language="id">
                                        @if ($errors->has('bulan'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('bulan') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row {{ $errors->has('jumlah') ? ' is-invalid' : '' }}">
                                    <div class="col-md-12">
                                            <label for="jumlah">Jumlah</label>
                                            <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Masukan Jumlah Produk Masuk">
                                        @if ($errors->has('jumlah'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('jumlah') }}</strong>
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

</script>

@endpush
