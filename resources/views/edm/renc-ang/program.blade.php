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
            <p class="card-title">Executive Dashboard Management: Setiap Program dalam Bidang</p>
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
                <p class="card-title">Persentase Realisasi Tiap Program</p>
                <p class="font-weight-500 card-caption">Menampilkan Grafik Analisa Capaian untuk Aspek tertentu</p>
                <canvas id="line-program"></canvas>
                <center>
                    <h3 id="line-program-loading-notif">Loading Chart</h3>
                </center>
            </div>
        </div>
    </div>
    <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <p class="card-title">Detail Tiap Program</p>
            <p class="font-weight-500 card-caption">Menampilkan Grafik Analisa Capaian untuk Aspek tertentu</p>
            @foreach($kegiatans as $kegiatan)
            <p><a href="{{ route('edm.renc-ang.kegiatan', ['kegiatan' => $kegiatan->kegiatan_id]) }}">{{ $kegiatan->kegiatan_nama }}</a></p>
            @endforeach
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $.get('{{ route('graph.renc-ang.semua-kegiatan', $program_id) }}', function(data){
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
        new Chart($('#line-program'), {
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
        $('#line-program-loading-notif').hide();
    })
</script>
@endsection