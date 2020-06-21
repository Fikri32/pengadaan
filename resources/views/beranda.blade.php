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
    <div class="row invisible" data-toggle="appear">
        <!-- Row #2 -->
        <div class="col-md-12">
            <div class="block block-rounded block-bordered">
                <div class="block-header block-header-default border-b">
                    <h3 class="block-title">
                        Grafik Bahan Baku <small>2019</small>
                    </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                        <button type="button" class="btn-block-option">
                            <i class="si si-wrench"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content block-content-full">
                    <div class="pull-all pt-50">
                        <!-- Lines Chart Container -->
                        <canvas id="grafik-BahanBaku"></canvas>
                    </div>
                </div>
                <div class="block-content">

                </div>
            </div>
        </div>
        <!-- END Row #2 -->
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
