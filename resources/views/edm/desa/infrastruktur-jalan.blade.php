<?php
$edm = true
?>
@extends('layouts.index')
@section('content')
@include('edm.desa.index')
@if(true)
 <h1> Data Tidak Tersedia </h1>
@else
<div class="row" style="margin-bottom: 32px">
  <div class="col-md-4 stretch-card grid-margin grid-margin-md-0">
    <div class="card data-icon-card-primary">
      <div class="card-body">
        <p class="card-title text-white">Total Jalan Kabupaten</p>                      
        <div class="row">
          <div class="col-12 text-white">
            <h3>40 ruas</h3>
            <p class="text-white font-weight-500 mb-0">The total number of sessions within the date range.It is calculated as the sum . </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4 stretch-card grid-margin grid-margin-md-0">
    <div class="card data-icon-card-primary">
      <div class="card-body">
        <p class="card-title text-white">Total Panjang Jalan Kabupaten di Desa {{ $desa->name }} </p>                      
        <div class="row">
          <div class="col-12 text-white">
            <h3>823 km</h3>
            <p class="text-white font-weight-500 mb-0">The total number of sessions within the date range.It is calculated as the sum . </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4 stretch-card grid-margin grid-margin-md-0">
    <div class="card data-icon-card-primary">
      <div class="card-body">
        <p class="card-title text-white">Prosentase Jalan Kabupaten di Desa {{ $desa->name }}  Berstatus Baik</p>                      
        <div class="row">
          <div class="col-12 text-white">
            <h3>65%</h3>
            <p class="text-white font-weight-500 mb-0">The total number of sessions within the date range.It is calculated as the sum . </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
              <p class="card-title">Kondisi Jalan</p>
              <canvas id="kondisi-jalan"></canvas>
              <div class="caption-with-link">
                  <p>
                      <a href="{{ url('edm/infrastruktur-jalan/kondisi/baik') }}">Jalan Dengan Kondisi Baik: 40000</a>
                  </p>
                  <p>
                      <a href="{{ url('edm/infrastruktur-jalan/kondisi/baik') }}">Jalan Dengan Kondisi Rusak Ringan: 40000</a>
                  </p>
                  <p>
                      <a href="{{ url('edm/infrastruktur-jalan/kondisi/baik') }}">Jalan Dengan Kondisi Rusak Berat: 40000</a>
                  </p>
              </div>
            </div>
        </div>
    </div>
    <div class="col-md-8 grid-margin stretch-card">
      <div class="card">
          <div class="card-body">
            <p class="card-title">Grafik Sandingan Kondisi Jalan Per Tahun</p>
            <canvas id="perkembangan-jalan"></canvas>
          </div>
      </div>
  </div>
  <div class="col-md-4 grid-margin stretch-card">
    <div class="card autoscroll">
        <div class="card-body">
          <p class="card-title">Status Infrastruktur Jalan</p>
          <table class="datatable">
            <thead>
                <td>Nama Jalan</td>
                <td>Tanggal Survey</td>
                <td>Keterangan</td>
            </thead>
            <?php $counterJalan = 1;
                $jalans = ['Batas Kab. Madiun/Ponorogo - Batas Kota Ponorogo', 'Jl. Arif Rachman Hakim', 'Jl. Letjen S. Parman', 'Jl. MT. Haryono', 'Jl. Diponegoro', 'Jl. Alun-alun Barat', 'Jl. Gatot Subroto', 'Dengok - Batas Kab. Ponorogo/Trenggalek', 'Batas Kota Ponorogo - Dengok'];
                $panjang = ['5.23', '1.73', '1.8', '1.66', '0.57', '0.21', '0.63','28.07','2.86'];
                $status = ['baik', 'rusak ringan', 'rusak berat'];
            ?>
            @foreach($jalans as $jalan)
            <tr>
                <td>{{$jalan}}</td>
                <td>{{ rand(1,29) }} Maret 2023</td>
                <td>{{ $status[rand(0,2)] }}</td>
            </tr>
            @endforeach
        </table>
        </div>
    </div>
  </div>
  <div class="col-md-8 grid-margin stretch-card">
    <div class="card">
        <div class="card-body"> 
          <p class="card-title">List Jalan Kabupaten yang Dilewati</p>
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
@endif
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
    }
    var southAmericaChartCanvas = $("#kondisi-jalan").get(0).getContext("2d");
    var southAmericaChart = new Chart(southAmericaChartCanvas, {
        type: 'doughnut',
        data: areaData,
        options: areaOptions
        });

    // PERKEMBANGAN JALAN //
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
    
</script>
@endsection
