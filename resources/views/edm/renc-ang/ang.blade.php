<?php
$edm = true
?>
@extends('layouts.index')
@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
            <p class="card-title">Executive Dashboard Management: Target dan Realisasi Anggaran</p>
            </div>
            <p class="font-weight-500">Menampilkan hasil analisis visual dari data masuk yang destinasi wisata di daerah Kab. Ponorogo</p>
          </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-9 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title">Persentase Realisasi Tiap Urusan</p>
            <p class="font-weight-500 card-caption">Menampilkan Grafik Analisa Capaian untuk Aspek tertentu</p>
            <canvas id="line-urusan"></canvas>
            <center>
                <h3 id="line-urusan-loading-notif">Loading Chart</h3>
            </center>
            </div>
        </div>
    </div>
    <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title">Detail Tiap Urusasn</p>
            <p class="font-weight-500 card-caption">Menampilkan Grafik Analisa Capaian untuk Aspek tertentu</p>
            @foreach($urusans as $urusan)
            <p><a href="{{ route('edm.renc-ang.urusan', $urusan->urusan_id) }}">{{ $urusan->urusan_nama }}</a></p>
            @endforeach
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $.get('{{ route('graph.renc-ang.semua-urusan') }}', function(data){
        console.log(data);
        datasets = [];
        scales = {};
        for (i in data.persen_realisasis){
            datasets.push({
                label: data.labels[i],
                data: data.persen_realisasis[i],
                borderColor: randomColor(),
                backgroundColor: false
            })

            scales['y_'+i.toString()] = {
                type: 'linear',
                display: true,
                position: 'left'
            }
        }
        console.log(datasets);
        console.log(scales);
        new Chart($('#line-urusan'), {
		type : 'line',
            data : {
                labels : data.x_axis,
                datasets: datasets
            },
            options : {
                title : {
                    display : false,
                },
                scales: scales
            }
	    });
        $('#line-urusan-loading-notif').hide();
    })
</script>
@endsection