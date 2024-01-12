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
            <p class="card-title">Executive Dashboard Management Infrastruktur Jalan di Desa {{ $desa->name }}</p>
            </div>
            <p class="font-weight-500">Menampilkan hasil analisis visual dari data masuk yang berkaitan tentang jalan di Desa {{ $desa->name }}</p>
          </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-7 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <img src="{{ asset('img/peta-png.jpg') }}" style="width: 100%">
            <p class="card-title">Tentang Desa {{ $desa->name }}</p>
            <div class="row">
                <div class="col-sm-6">
                    <table>
                        <tr><td>Luas Wilayah</td><td>:</td><td>345km<sup>2</sup></td></tr>
                        <tr><td>Total Panjang Jalan Kabupaten</td><td>:</td><td> 12345km</td></tr>
                        <tr><td>Kondisi secara keseluruhan</td><td>:</td><td> Butuh Perhatian</td></tr>
                    </table>
                </div>
                <div class="col-sm-6">
                    <table>
                        <tr><td>Nama Kades/Lurah</td><td>:</td><td>Dr. Sulistyowati</td></tr>
                        <tr><td>Alamat Kades/Lurah</td><td>:</td><td>Jl. Arjuna no. 35 Ponorogo</td></tr>
                        <tr><td>Nomor Telefon Kades/Lurah</td><td>:</td><td>08123456789</td></tr>
                    </table>
                </div>
            </div>
          </div>
        </div>
    </div>
    <div class="col-md-5 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title">List Jalan</p>
            <p class="font-weight-500 card-caption">Menampilkan data jalan beserta panjang dan statusnya. Data yang dihasilkan terupdate secara berkala sesuai dengan hasil survey petugas di lapangan</p>
            <table class="datatable">
                <thead>
                    <td>No.</td>
                    <td>Nama Jalan</td>
                    <td>Panjang Total (km)</td>
                    <td>Kondisi</td>
                    <td>Tanggal Survey</td>
                </thead>
                <?php $counterJalan = 1;
                    $jalans = ['Batas Kab. Madiun/Ponorogo - Batas Kota Ponorogo', 'Jl. Arif Rachman Hakim', 'Jl. Letjen S. Parman', 'Jl. MT. Haryono', 'Jl. Diponegoro', 'Jl. Alun-alun Barat', 'Jl. Gatot Subroto', 'Dengok - Batas Kab. Ponorogo/Trenggalek', 'Batas Kota Ponorogo - Dengok'];
                    $panjang = ['5.23', '1.73', '1.8', '1.66', '0.57', '0.21', '0.63','28.07','2.86'];
                    $status = ['baik', 'rusak ringan', 'rusak berat'];
                ?>
                @foreach($jalans as $jalan)
                <tr>
                    <td>{{$counterJalan++}}</td>
                    <td>{{$jalan}}</td>
                    <td>{{$panjang[$counterJalan-2]}}</td>
                    <td>{{ $status[rand(0,2)] }}</td>
                    <td>{{ rand(1,29) }} Maret 2023</td>
                </tr>
                @endforeach
            </table>
          </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
            <p class="card-title">Rekapitulasi Kondisi Jalan</p>
            </div>
            <p class="font-weight-500">Rekapitulasi kondisi Jalan Kabupaten di Desa {{ $desa->name }}</p>
            <canvas id="south-america-chart"></canvas>
            <div class="caption-with-link">
                <p>
                    <a href="#">Jalan Dengan Kondisi Baik: 40000</a>
                </p>
                <p>
                    <a href="#">Jalan Dengan Kondisi Rusak Ringan: 40000</a>
                </p>
                <p>
                    <a href="#">Jalan Dengan Kondisi Rusak Berat: 40000</a>
                </p>
            </div>
          </div>
        </div>
    </div>
    <div class="col-md-9 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
            <p class="card-title">Grafik Status Jalan Per Tahun</p>
            </div>
            <p class="font-weight-500">Menampilkan grafik perkembangan jalan dari tahun ke tahun sesuai data yang dimasukkan oleh operator</p>
            <canvas id="perkembangan-jalan"></canvas>
          </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    var areaData = {
        labels: ["Kondisi Baik", "Rusak Ringan", "Rusak Berat"],
        datasets: [{
        data: [65, 25, 10],
        backgroundColor: [
            "#4B49AC","#FFC100", "#248AFD",
        ],
        borderColor: "rgba(0,0,0,0)"
        }
        ]
    };
    var areaOptions = {
    responsive: true,
    maintainAspectRatio: true,
    segmentShowStroke: false,
    elements: {
    arc: {
        borderWidth: 4
    }
    },      
    legend: {
    display: false
    },
    tooltips: {
    enabled: true
    },
    legendCallback: function(chart) { 
    var text = [];
    text.push('<div class="report-chart">');
    text.push('<div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center"><div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: ' + chart.data.datasets[0].backgroundColor[0] + '"></div><p class="mb-0">Kondisi Baik</p></div>');
    text.push('<p class="mb-0">495343</p>');
    text.push('</div>');
    text.push('<div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center"><div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: ' + chart.data.datasets[0].backgroundColor[1] + '"></div><p class="mb-0">Rusak Ringan</p></div>');
    text.push('<p class="mb-0">630983</p>');
    text.push('</div>');
    text.push('<div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center"><div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: ' + chart.data.datasets[0].backgroundColor[2] + '"></div><p class="mb-0">Rusak Berat</p></div>');
    text.push('<p class="mb-0">290831</p>');
    text.push('</div>');
    text.push('</div>');
    return text.join("");
    },
    }
    var southAmericaChartPlugins = {
    beforeDraw: function(chart) {
    var width = chart.chart.width,
        height = chart.chart.height,
        ctx = chart.chart.ctx;

    ctx.restore();
    var fontSize = 3.125;
    ctx.font = "600 " + fontSize + "em sans-serif";
    ctx.textBaseline = "middle";
    ctx.fillStyle = "#000";
    ctx.save();
    }
    }
    var southAmericaChartCanvas = $("#south-america-chart").get(0).getContext("2d");
    var southAmericaChart = new Chart(southAmericaChartCanvas, {
        type: 'doughnut',
        data: areaData,
        options: areaOptions,
        plugins: southAmericaChartPlugins
        });

        /*
        LINE CHART
        */
    const labels = ['2019', '2020', '2021', '2022', '2023'];
    
    const lineCanvas = $('#perkembangan-jalan');
    new Chart(lineCanvas, {
		type : 'line',
		data : {
			labels : labels,
			datasets: [
                {
                    label: 'Kondisi Baik',
                    data: [92751,81105,71635,41005,31168],
                    borderColor: '#00f',
                    yAxesID: 'y',
                    fill: false
                },
                {
                    label: 'Rusak Ringan',
                    data: [26031,41523,94200,40806,35017],
                    borderColor: '#ff0',
                    yAxesID: 'y1',
                    fill: false
                },
                {
                    label: 'Rusak Berat',
                    data: [44268,54556,94538,12516,80184],
                    borderColor: '#f00',
                    yAxesID: 'y2',
                    fill: false
                }
            ]
		},
		options : {
			title : {
				display : false,
				text : 'Chart JS Line Chart Example'
			},
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                },
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                },
                y2: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                },
            }
		}
	});
    // var lineChart = new Chart(lineCanvas, config);
</script>
@endsection