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
            <p class="card-title">Executive Dashboard Management Tempat Wisata: {{ $name }}</p>
            </div>
            <p class="font-weight-500">Menampilkan hasil analisis visual dari data masuk yang berkaitan tempat wisata {{ $name }}</p>
          </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-7 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <img src="{{ asset('img/peta-png.jpg') }}" style="width: 100%">
            <p class="card-title">Tentang Tempat Wisata {{ $name }}</p>
          </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="row">
            <div class="card col-md-12 grid-margin">
                <div class="card-body">
                  <p class="card-title">Realtime Update</p>
                  <p class="font-weight-500 card-caption">Menampilkan informasi terbaru dari tempat wisata ini</p>
                  <div class="row" style="margin-top: 36px">
                    <div class="col-md-4">
                        <p>Jumlah pengunjung terupdate</p>
                        <h3>30</h3>
                        <p>Kemarin</p>
                    </div>
                    <div class="col-md-4">
                        <p>Peningkatan Pengunjung</p>
                        <h3><i class="ti-arrow-up text-primary"></i>24%</h3>
                        <p>Kemarin</p>
                    </div>
                    <div class="col-md-4">
                        <p>Peak Visitor</p>
                        <h3>304</h3>
                        <p>23 Februari 2023</p>
                    </div>
                    <div class="col-md-6">
                        <p>Harga TIket Masuk</p>
                        <h3>Rp. 5.000</h3>
                        <p>Kemarin</p>
                    </div>
                    <div class="col-md-6">
                        <p>Total Revenue</p>
                        <h3>Rp. 1.500.000</h3>
                        <p>Kemarin</p>
                    </div>
                  </div>
                </div>
            </div>
            <div class="card col-md-12 grid-margin">
                <div class="card-body">
                  <p class="card-title">Statistik Pengunjung </p>
                  <p class="font-weight-500 card-caption">Menampilkan statistik pengunjung per hari dalam 7 hari terakhir</p>
                  <canvas id="perkembangan-jalan"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title">Sandingan Data Pengunjung Per Tahun</p>
            <p class="font-weight-500 card-caption">Menampilkan data perbandingan pengunjung per bulan per tahun pada tempat wisata {{ $name }}</p>
            <canvas id="sandingan-tahun"></canvas>
          </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
        /*
        LINE CHART
        */
    const labels = ['1 Maret 2023', '2 Maret 2023', '3 Maret 2023', '4 Maret 2023', '5 Maret 2023', '6 Maret 2023', '7 Maret 2023'];
    const lineCanvas = $('#perkembangan-jalan');
    new Chart(lineCanvas, {
		type : 'line',
		data : {
			labels : labels,
			datasets: [
                {
                    label: 'Visitor 7 hari terakhir',
                    data: [10, 13, 12, 15, 17, 19, 50],
                    borderColor: '#00f',
                    yAxesID: 'y',
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
                }
            }
		}
	});
    
    
    /*
    CHART SANDINGAN PER TAHUN
    */
   const labelBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    new Chart($('#sandingan-tahun'), {
        type : 'line',
		data : {
			labels : labelBulan,
			datasets: [
                {
                    label: '2019',
                    data: [56521,82599,78832,28841,46745,20592,33770,89044,34226,92783,92995,14606],
                    borderColor: '#f00',
                    yAxesID: 'y',
                    fill: false
                },
                {
                    label: '2020',
                    data: [81179,95759,76918,26408,89174,51499,17390,69086,87637,70473,15359,79373],
                    borderColor: '#ff0',
                    yAxesID: 'y1',
                    fill: false
                },
                {
                    label: '2021',
                    data: [38992,72436,7281,76297,38191,19347,92946,33355,17326,68342,73889,16883],
                    borderColor: '#0ff',
                    yAxesID: 'y2',
                    fill: false
                },
                {
                    label: '2022',
                    data: [24312,21176,29892,59159,98614,33904,22817,8546,88713,88697,71210,91786],
                    borderColor: '#0f0',
                    yAxesID: 'y3',
                    fill: false
                },
                {
                    label: '2023',
                    data: [2590,14029,88258,14089,27007,65545,17613,30863,92179,57344,54254,62482],
                    borderColor: '#00f',
                    yAxesID: 'y4',
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
                y3: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                },
                y4: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                },
            }
		}
    });
</script>
@endsection