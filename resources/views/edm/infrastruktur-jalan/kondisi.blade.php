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
            <p class="card-title">Executive Dashboard Management Infrastruktur Jalan dengan Kondisi: {{ $status }}</p>
            </div>
            <p class="font-weight-500">Menampilkan hasil analisis visual dari data masuk yang berkaitan tentang jalan di daerah Kab. Ponorogo</p>
          </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-7 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
            <p class="card-title">Sebaran Kondisi Jalan {{ $status }} tiap Kecamatan</p>
            </div>
            <p class="font-weight-500">Menampilkan data persebaran panjang jalan yang berstatus {{ $status}} di tiap kecamatan sesuai dengan data yang sudah dimasukkan oleh operator dinas</p>
            <canvas id="sebaran-kecamatan"></canvas>
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
                ?>
                @foreach($jalans as $jalan)
                <tr>
                    <td>{{$counterJalan++}}</td>
                    <td>{{$jalan}}</td>
                    <td>{{$panjang[$counterJalan-2]}}</td>
                    <td>{{ $status }}</td>
                    <td>{{ rand(1,29) }} Maret 2023</td>
                </tr>
                @endforeach
            </table>
          </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    var labelKecamatan = [];
    var dataKecamatan = [];
    @foreach($kecamatans as $kecamatan)
        labelKecamatan.push("{{ $kecamatan->name }}")
        dataKecamatan.push(1000+Math.floor(Math.random() * 15000))
    @endforeach
    new Chart(document.getElementById("sebaran-kecamatan"), {
			type: 'bar',
			data: {
				labels: labelKecamatan,
				datasets: [
					{
						data: dataKecamatan
					}
				]
			},
			options: {
                indexAxis: 'y',
                responsive: true,
				legend: { display: false },
				title: {
					display: false,
					text: 'Chart JS Bar Chart Example'
				}
			}
		});
</script>
@endsection