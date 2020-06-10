@extends('layouts.master')

@section('content')
<div class="bg-image" style="background-image: url('assets/img/photos/photo21@2x.jpg');">
    <div class="bg-primary-dark-op">
        <div class="content content-full content-top">
            <h1 class="py-50 text-white text-center">Tambah Bahan Baku Keluar</h1>
        </div>
    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <!-- Default Elements -->
            <div class="block block-rounded">
                <div class="block-content">
                    <form action="{{ route('bahanbaku.keluar') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group row {{ $errors->has('no_indeks') ? ' is-invalid' : '' }}">
                                    <div class="col-md-12">
                                        <div class="form-material form-material-primary ">
                                            <input type="text" class="form-control" id="no_indeks" name="no_indeks" placeholder="Masukan No Indeks">
                                            <label for="no_indeks">No. Indeks</label>
                                        </div>
                                        @if ($errors->has('no_indeks'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('no_indeks') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row {{ $errors->has('no_surat') ? ' is-invalid' : '' }}">
                                    <div class="col-md-12">
                                        <div class="form-material form-material-primary ">
                                            <input type="text" class="form-control" id="no_surat" name="no_surat" placeholder="Masukan No Surat">
                                            <label for="no_surat">No. Surat</label>
                                        </div>
                                        @if ($errors->has('no_surat'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('no_surat') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row {{ $errors->has('perihal') ? ' is-invalid' : '' }}">
                                    <div class="col-md-12">
                                        <div class="form-material form-material-primary ">
                                            <input type="text" class="form-control" id="perihal" name="perihal" placeholder="Masukan Perihal Surat">
                                            <label for="perihal">Perihal</label>
                                        </div>
                                        @if ($errors->has('perihal'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('perihal') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row {{ $errors->has('sifat') ? ' is-invalid' : '' }}">
                                    <div class="col-md-12">
                                        <div class="form-material form-material-primary ">
                                            <select class="form-control" name="sifat" id="sifat">
                                                <option value="">Pilih Sifat Surat</option>
                                                <option value="Amat Segera">Amat Segera</option>
                                                <option value="Segera">Segera</option>
                                                <option value="Biasa">Biasa</option>
                                            </select>
                                            <label for="sifat">Sifat Surat</label>
                                        </div>
                                        @if ($errors->has('sifat'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('sifat') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row {{ $errors->has('media') ? ' is-invalid' : '' }}">
                                    <div class="col-md-12">
                                        <div class="form-material form-material-primary ">
                                            <select class="form-control" name="media" id="media">
                                                <option value="">Pilih Media Surat</option>
                                                <option value="Hardcopy">Hardcopy</option>
                                                <option value="Softcopy">Softcopy</option>
                                            </select>
                                            <label for="media">Media Surat</label>
                                        </div>
                                        @if ($errors->has('media'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('media') }}</strong>
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
