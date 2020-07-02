@extends('layouts.master')

@section('content')
<div class="bg-image" style="background-image: url('assets/img/photos/photo21@2x.jpg');">
    <div class="bg-primary-dark-op">
        <div class="content content-full content-top">
            <h1 class="py-50 text-white text-center">Edit Produk Masuk</h1>
        </div>
    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <!-- Default Elements -->
            <div class="block block-rounded">
                <div class="block-content">
                @foreach($masuk as $s)
                    <form action="{{route('produkmasuk.update',$s->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group row {{ $errors->has('produk') ? ' is-invalid' : '' }}">
                                    <div class="col-md-12">
                                            <label for="pengolah">Produk</label>
                                            <select class="form-control" name="produk" id="produk">
                                                <option value="{{$s->id_produk}}">Default-{{$s->produk->nama}}</option>
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
                                <div class="form-group row {{ $errors->has('tanggal') ? ' is-invalid' : '' }}">
                                    <div class="col-md-12">
                                            <label label for="tanggal">Tanggal</label>
                                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{$s->tanggal}}" placeholder="Masukan Stok Produk">
                                        @if ($errors->has('tanggal'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('tanggal') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row {{ $errors->has('jumlah') ? ' is-invalid' : '' }}">
                                    <div class="col-md-12">
                                            <label for="jumlah">Jumlah</label>
                                            <input type="text" class="form-control" id="jumlah" name="jumlah" value="{{$s->jumlah}}" placeholder="Masukan Stok Produk">
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
                    @endforeach

                </div>
            </div>
            <!-- END Default Elements -->
        </div>
    </div>
</div>
@stop

@push('scripts')
<script>
    $("#input-ficons-5").fileinput();
</script>

@endpush
