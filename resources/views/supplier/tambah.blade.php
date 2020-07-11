@extends('layouts.master')

@section('content')
<div class="bg-image" style="background-image: url('assets/img/photos/photo21@2x.jpg');">
    <div class="bg-primary-dark-op">
        <div class="content content-full content-top">
            <h1 class="py-50 text-white text-center">Tambah Supplier</h1>
        </div>
    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <!-- Default Elements -->
            <div class="block block-rounded">
                <div class="block-content">
                    <form action="{{ route('supplier.tambah') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group row {{ $errors->has('nama') ? ' is-invalid' : '' }}">
                                    <div class="col-md-12">
                                        <label for="nama">Nama Supplier</label>
                                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama Supplier">
                                        @if ($errors->has('nama'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('nama') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row {{ $errors->has('alamat') ? ' is-invalid' : '' }}">
                                    <div class="col-md-12">
                                        <label for="alamat">Alamat</label>
                                            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukan Alamat Supplier">
                                        @if ($errors->has('alamat'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('alamat') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row {{ $errors->has('no_telp') ? ' is-invalid' : '' }}">
                                    <div class="col-md-12">
                                        <label for="no_telp">No. Telepon</label>
                                            <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Masukan No telepon Supplier">
                                        @if ($errors->has('no_telp'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('no_telp') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row {{ $errors->has('fax') ? ' is-invalid' : '' }}">
                                    <div class="col-md-12">
                                        <label for="email">Fax</label>
                                            <input type="text" class="form-control" id="fax" name="fax" placeholder="Masukan Fax Supplier">
                                        @if ($errors->has('fax'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('fax') }}</strong>
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
    $("#input-ficons-5").fileinput();
</script>

@endpush
