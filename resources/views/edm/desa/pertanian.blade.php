<?php
$edm = true
?>
@extends('layouts.index')
@section('content')
@include('edm.desa.index')
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
    <div class="col-md-4 grid-margin stretch-card">
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
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <div class="row">
                <div class="col-sm-12">
                  <p class="card-title" style="margin-bottom: 62px">List Lahan Pertanian</p>
                  <p class="font-weight-500">Menampilkan daftar semua TK/PAUD diurutkan berdasarkan jumlah muridnya</p>
                  <table id="list-lahan-pertanian">
                    <thead>
                        <td>Nama Petani</td>
                        <td>Kelompok Masyarakat</td>
                        <td>Jenis Lahan</td>
                        <td>Luas Lahan (Ha)</td>
                        <td>Komoditas</td>
                      </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="col-md-7 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <div class="row">
              <div class="col-sm-12">
                <p class="card-title" style="margin-bottom: 62px">Anggota Kelompok Tani</p>
                <canvas id="list-poktan" style="height: 200px"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
  <div class="col-md-5 grid-margin stretch-card">
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
@endsection
@section('scripts')
<script>
  $.get('{{ route('graph-desa.pertanian.cards', $desa->id) }}', function(data){
    $('#card-komoditas').text(data[0]);
    $('#card-poktan').text(data[1]);
    $('#card-petani').text(data[2]);
    $('#card-lahan').text(data[3] + ' Ha');
  });

  $.get('{{ route('graph-desa.pertanian.jenis-lahan', $desa->id) }}', function(data){
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

  $.get('{{ route('graph-desa.pertanian.komoditas-lahan', $desa->id) }}', function(data){
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

  $.get('{{ route('graph-desa.pertanian.list-poktan', $desa->id) }}', function(data){
    new Chart(document.getElementById("list-poktan"), {
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
  $.get('{{ route('graph-desa.pertanian.list-lahan-pertanian', $desa->id) }}', function(data){
    $('#list-lahan-pertanian').DataTable({
      data: data
    });
    
  })
</script>
@endsection