@extends('layouts.master')

@section('content')
<div class="bg-image" style="background-image: url('assets/img/photos/photo21@2x.jpg');">
    <div class="bg-primary-dark-op">
        <div class="content content-full content-top">
            <h1 class="py-50 text-white text-center">Edit Bahan Baku Keluar</h1>
        </div>
    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <!-- Default Elements -->
            <div class="block block-rounded">
                <div class="block-content">
                    @foreach($keluar as $d)
                    <form action="{{route('keluar.update',$d->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                            <div class="form-group row {{ $errors->has('bahan') ? ' is-invalid' : '' }}">
                                    <div class="col-md-12">
                                            <label for="pengolah">Nama Bahan Baku</label>
                                            <select class="form-control" name="bahan" id="bahan" value = "">
                                                <!-- <option value="{{ $d->id }}">{{ ucfirst($d->bahanbaku->nama) }}</option> -->
                                                <option value="{{$d->id_bahan}}">Default-{{$d->bahanbaku->nama}}</option>
                                                @foreach($bahan as $s)
                                                <option value="{{ $s->id }}" >{{ ucfirst($s->nama) }}</option>
                                                @endforeach
                                            </select>
                                        @if ($errors->has('bahan'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('bahan') }}</strong>
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
                                <div class="form-group row {{ $errors->has('tgl_keluar') ? ' is-invalid' : '' }}">
                                    <div class="col-md-12">
                                            <label for="tgl_keluar">Tanggal Keluar</label>
                                            <input type="date" class="form-control" id="tgl_keluar" name="tgl_keluar" value = "{{$d->tgl_keluar}}" data-date-format="dd-mm-yyyy" data-language="id" placeholder="Masukan tgl_keluar Bahan Baku">
                                        @if ($errors->has('tgl_keluar'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('tgl_keluar') }}</strong>
                                            </div>
                                        @endif
                                    </div>
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
