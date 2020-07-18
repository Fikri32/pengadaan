@extends('layouts.master')

@section('content')
<div class="bg-image" style="background-image: url('assets/img/photos/photo21@2x.jpg');">
    <div class="bg-primary-dark-op">
        <div class="content content-full content-top">
            <h1 class="py-50 text-white text-center">  Welcome {{ Auth::user()->name }}!</h1>
        </div>
    </div>
</div>

<div class="bg-body-dark">
    <div class="content">

    </div>
</div>

<div class="content">
    <div class="row gutters-tiny invisible" data-toggle="appear">
        <!-- Row #1 -->
        <div class="col-6 col-xl-4">
            <a class="block block-link-rotate block-transparent text-right bg-primary-lighter" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix">
                    <div class="float-left mt-10 d-none d-sm-block">
                        <i class=" si si-social-dropbox fa-3x text-primary"></i>
                    </div>
                    @foreach($bahan as $s)
                    <div class="font-size-h3 font-w600 text-primary-darker" data-toggle="countTo" data-speed="1000" data-to="{{$s->stok}}"> MT </div>
                    <div class="font-size-sm font-w600 text-uppercase text-primary-dark">Persediaan Bahan Baku {{$s->nama}} </div>
                    @endforeach
                </div>
            </a>
        </div>
        <div class="col-6 col-xl-4">
            <a class="block block-link-rotate block-transparent text-right bg-primary-lighter" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix">
                    <div class="float-left mt-10 d-none d-sm-block">
                        <i class="si si-handbag fa-3x text-primary"></i>
                    </div>
                    <div>
                        @foreach($produk as $d)
                        <div class="font-size-h3 font-w600 text-primary-darker"><span data-toggle="countTo" data-speed="1000" data-to="{{$d->stok}}"></span> Ton </div>
                        <div class="font-size-sm font-w600 text-uppercase text-primary-dark">Persediaan Produk {{$d->nama}}</div>
                        @endforeach
                    </div>

                </div>
            </a>
        </div>
        <div class="col-6 col-xl-4">
            <a class="block block-link-rotate block-transparent text-right bg-primary-lighter" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix">
                    <div class="float-left mt-10 d-none d-sm-block">
                        <i class="fa fa-dollar fa-3x text-primary"></i>
                    </div>
                    <div class="font-size-h3 font-w600 text-primary-darker"><span data-toggle="countTo" data-speed="1000" data-to="{{$penjualan}}"></span> Ton </div>
                    <div class="font-size-sm font-w600 text-uppercase text-primary-dark">Produk Chips Terjual</div>
                    <div class="font-size-h3 font-w600 text-primary-darker"><span data-toggle="countTo" data-speed="1000" data-to="{{$Fiber}}"></span> Ton </div>
                    <div class="font-size-sm font-w600 text-uppercase text-primary-dark">Produk Fiber Terjual</div>
                </div>
            </a>
        </div>


        <!-- END Row #1
    </div>
</div>
@stop
@push('scripts')
<script>
var ctx = document.getElementById("grafik-BahanBaku").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
        datasets: [
            {
                label: 'Bahan Baku Masuk',
                fill: true,
                backgroundColor: 'rgba(66,165,245,.75)',
                borderColor: 'rgba(66,165,245,1)',
                pointBackgroundColor: 'rgba(66,165,245,1)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgba(66,165,245,1)',

            },
            {
                label: 'Bahan Baku Keluar',
                fill: true,
                backgroundColor: 'rgba(66,165,245,.25)',
                borderColor: 'rgba(66,165,245,1)',
                pointBackgroundColor: 'rgba(66,165,245,1)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgba(66,165,245,1)',

            }
        ]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>
@endpush
