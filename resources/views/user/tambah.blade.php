@extends('layouts.master')

@section('content')
<div class="bg-image" style="background-image: url('assets/img/photos/photo21@2x.jpg');">
    <div class="bg-primary-dark-op">
        <div class="content content-full content-top">
            <h1 class="py-50 text-white text-center">Tambah Pengguna</h1>
        </div>
    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <!-- Default Elements -->
            <div class="block block-rounded">
                <div class="block-content">
                    <form action="{{ route('pengguna.tambah') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group row {{ $errors->has('nama') ? ' is-invalid' : '' }}">
                                    <div class="col-md-12">
                                        <label for="nama">Nama Pengguna</label>
                                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama Pengguna">
                                        @if ($errors->has('nama'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('nama') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row {{ $errors->has('email') ? ' is-invalid' : '' }}">
                                    <div class="col-md-12">
                                        <label for="alamat">Email</label>
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Masukan Alamat Email">
                                        @if ($errors->has('email'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row {{ $errors->has('Password') ? ' is-invalid' : '' }}">
                                    <div class="col-md-12">
                                        <label for="no_telp">Password</label>
                                            <input type="text" class="form-control" id="password" name="password" placeholder="Masukan Password Pengguna">
                                        @if ($errors->has('Password'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('Password') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row {{ $errors->has('role') ? ' is-invalid' : '' }}">
                                    <div class="col-md-12">
                                            <label for="pengolah">Role</label>
                                            <select class="form-control" name="role" id="role">
                                                <option value="">Pilih Role</option>
                                                @foreach($role as $d)
                                                <option value="{{ $d->id }}">{{ ucfirst($d->name) }}</option>
                                                @endforeach
                                            </select>
                                        @if ($errors->has('role'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('role') }}</strong>
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
