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
            <p class="card-title">Executive Dashboard Management Infrastruktur Jembatan dengan Kondisi: {{ $status }}</p>
            </div>
            <p class="font-weight-500">Menampilkan hasil analisis visual dari data masuk yang berkaitan tentang Jembatan di daerah Kab. Ponorogo</p>
          </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-7 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
            <p class="card-title">Sebaran Kondisi Jembatan {{ $status }} tiap Kecamatan</p>
            </div>
            <p class="font-weight-500">Menampilkan data persebaran panjang Jembatan yang berstatus {{ $status}} di tiap kecamatan sesuai dengan data yang sudah dimasukkan oleh operator dinas</p>
            <canvas id="sebaran-kecamatan"></canvas>
          </div>
        </div>
    </div>
    <div class="col-md-5 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title">List Jembatan</p>
            <p class="font-weight-500 card-caption">Menampilkan data Jembatan beserta panjang dan statusnya. Data yang dihasilkan terupdate secara berkala sesuai dengan hasil survey petugas di lapangan</p>
            <table class="datatable">
              <thead>
                  <td>No.</td>
                  <td>Nama Jembatan</td>
                  <td>Panjang Total (m)</td>
                  <td>Kondisi</td>
                  <td>Tanggal Survey</td>
              </thead>
              <?php $counterJembatan = 1;
                  $jembatans = ['Jembatan Ampera', 'Jembatan Tengku Agung Sultanah Latifah', 'Jembatan Suramadu', 'Jembatan Kutai Kartanegara', 'Jembatan Pasupati', 'Jembatan Barito', 'Jembatan merah Putih', 'Jembatan Mahakam Hulu', 'Jembatan Barelang', 'Jembatan Siak IV', 'Jembatan Rumpiang'];
                  $panjang = [1117, 1196, 5438, 710, 2800, 1082, 1140, 789, 0, 800, 753];
                  $status = ['baik', 'rusak ringan', 'rusak berat'];
              ?>
              @foreach($jembatans as $Jembatan)
              <tr>
                  <td>{{ $counterJembatan++ }}</td>
                  <td>{{ $Jembatan }}</td>
                  <td>{{ $panjang[$counterJembatan-2] }}</td>
                  <td>{{ $status[rand(0,2)] }}</td>
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