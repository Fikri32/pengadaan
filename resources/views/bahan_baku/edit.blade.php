@extends('layouts.master')

@section('content')
<div class="bg-image" style="background-image: url('assets/img/photos/photo21@2x.jpg');">
    <div class="bg-primary-dark-op">
        <div class="content content-full content-top">
            <h1 class="py-50 text-white text-center">Edit Bahan Baku</h1>
        </div>
    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <!-- Default Elements -->
            <div class="block block-rounded">
                <div class="block-content">
                    @foreach($baku as $d)
                    <form action="{{route('bahanbaku.update',$d->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group row {{ $errors->has('nama') ? ' is-invalid' : '' }}">
                                    <div class="col-md-12">
                                            <label for="no_indeks">Nama Bahan Baku</label>
                                            <input type="text" class="form-control" id="nama" name="nama" value = "{{$d->nama}}" placeholder="Masukan Nama Bahan Baku">
                                        @if ($errors->has('nama'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('nama') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row {{ $errors->has('jumlah') ? ' is-invalid' : '' }}">
                                    <div class="col-md-12">
                                            <label for="jumlah">Jumlah</label>
                                            <input type="text" class="form-control" id="jumlah" name="jumlah" value = "{{$d->jumlah}}" placeholder="Masukan Jumlah Bahan Baku">
                                        @if ($errors->has('jumlah'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('jumlah') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row {{ $errors->has('satuan') ? ' is-invalid' : '' }}">
                                    <div class="col-md-12">
                                            <label for="jumlah">Satuan</label>
                                            <input type="text" class="form-control" id="satuan" name="satuan" value = "{{$d->satuan}}" placeholder="Masukan Satuan Bahan Baku">
                                        @if ($errors->has('satuan'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('satuan') }}</strong>
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
