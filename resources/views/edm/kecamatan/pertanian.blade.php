<?php
$edm = true
?>
@extends('layouts.index')
@section('content')
@include('edm.kecamatan.index')
<div class="row" style="margin-bottom: 32px">
  <div class="col-md-3 stretch-card grid-margin grid-margin-md-0">
    <div class="card data-icon-card-primary">
      <div class="card-body">
        <p class="card-title text-white">Jumlah Komoditas</p>                      
        <div class="row">
          <div class="col-12 text-white">
            <h3 id="card-komoditas">~</h3>
            <p class="text-white font-weight-500 mb-0">The total number of sessions within the date range.It is calculated as the sum . </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3 stretch-card grid-margin grid-margin-md-0">
    <div class="card data-icon-card-primary">
      <div class="card-body">
        <p class="card-title text-white">Jumlah Kelompok Tani</p>                      
        <div class="row">
          <div class="col-12 text-white">
            <h3 id="card-poktan">~</h3>
            <p class="text-white font-weight-500 mb-0">The total number of sessions within the date range.It is calculated as the sum . </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3 stretch-card grid-margin grid-margin-md-0">
    <div class="card data-icon-card-primary">
      <div class="card-body">
        <p class="card-title text-white">Jumlah Total Petani</p>                      
        <div class="row">
          <div class="col-12 text-white">
            <h3 id="card-petani">~</h3>
            <p class="text-white font-weight-500 mb-0">The total number of sessions within the date range.It is calculated as the sum . </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3 stretch-card grid-margin grid-margin-md-0">
    <div class="card data-icon-card-primary">
      <div class="card-body">
        <p class="card-title text-white">Total Luas Lahan</p>                      
        <div class="row">
          <div class="col-12 text-white">
            <h3 id="card-lahan">~ Ha</h3>
            <p class="text-white font-weight-500 mb-0">The total number of sessions within the date range.It is calculated as the sum . </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title">Total Luas Lahan per Desa</p>
            <p class="font-weight-500 card-caption">Menampilkan grafik jumlah siswa keseluruhan per jenjang sekolah mulai TK/PAUD, SD, SMP, SMA</p>
            <canvas id="lahan-per-desa"></canvas>
          </div>
        </div>
    </div>
    <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <div class="row">
                <div class="col-sm-12">
                  <p class="card-title" style="margin-bottom: 62px">Jenis Lahan</p>
                  <canvas id="jenis-lahan" style="height: 200px"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <div class="row">
                <div class="col-sm-12">
                  <p class="card-title" style="margin-bottom: 62px">Sebaran Komoditas</p>
                  <canvas id="komoditas-lahan" style="height: 200px"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
            <p class="card-title">Poktan Per Desa</p>
            </div>
            <p class="font-weight-500">Menampilkan data hasil panen semua komoditas tiap tahun</p>
            <canvas id="poktan-per-desa"></canvas>
          </div>
        </div>
    </div>

    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
            <p class="card-title">Petani Per Desa</p>
            </div>
            <p class="font-weight-500">List semua kelompok tani yang terdaftar di wilayah Ponorogo</p>
            <canvas id="petani-per-desa"></canvas>

          </div>
        </div>
    </div>

</div>
@endsection
@section('scripts')
<script>
  $.get('{{ route('graph-kecamatan.pertanian.cards', $kecamatan->id) }}', function(data){
    $('#card-komoditas').text(data[0]);
    $('#card-poktan').text(data[1]);
    $('#card-petani').text(data[2]);
    $('#card-lahan').text(data[3] + ' Ha');
  });

  $.get('{{ route('graph-kecamatan.pertanian.lahan-per-desa', $kecamatan->id) }}', function(data){
    new Chart(document.getElementById("lahan-per-desa"), {
      type: 'bar',
      data: {
        labels: data.colnames,
        datasets: [
          {
            data: data.values,
            backgroundColor: randomColors(data.colnames.length),
          }
        ]
      },
      options: {
                indexAxis: 'y',
                responsive: true,
        legend: { display: false },
        title: {
          display: false,
        }
      }
    });
  });
  $.get('{{ route('graph-kecamatan.pertanian.jenis-lahan', $kecamatan->id) }}', function(data){
    new Chart(document.getElementById("jenis-lahan"), {
      type: 'doughnut',
      data: {
        labels: data.colnames,
        datasets: [{
          data: data.values,
          backgroundColor: randomColors(data.colnames.length),
          hoverOffset: 4
        }]
      }}
    );
  });

  $.get('{{ route('graph-kecamatan.pertanian.komoditas-lahan', $kecamatan->id) }}', function(data){
    new Chart(document.getElementById("komoditas-lahan"), {
      type: 'doughnut',
      data: {
        labels: data.colnames,
        datasets: [{
          data: data.values,
          backgroundColor: randomColors(data.colnames.length),
          hoverOffset: 4
        }]
      }}
    );
  });

  $.get('{{ route('graph-kecamatan.pertanian.poktan-per-desa', $kecamatan->id) }}', function(data){
    new Chart(document.getElementById("poktan-per-desa"), {
      type: 'bar',
      data: {
        labels: data.colnames,
        datasets: [
          {
            data: data.values,
            backgroundColor: randomColors(data.colnames.length),
          }
        ]
      },
      options: {
                indexAxis: 'y',
                responsive: true,
        legend: { display: false },
        title: {
          display: false,
        }
      }
    });
  });

  $.get('{{ route('graph-kecamatan.pertanian.petani-per-desa', $kecamatan->id) }}', function(data){
    new Chart(document.getElementById("petani-per-desa"), {
      type: 'bar',
      data: {
        labels: data.colnames,
        datasets: [
          {
            data: data.values,
            backgroundColor: randomColors(data.colnames.length),
          }
        ]
      },
      options: {
                indexAxis: 'y',
                responsive: true,
        legend: { display: false },
        title: {
          display: false,
        }
      }
    });
  });
</script>
@endsection