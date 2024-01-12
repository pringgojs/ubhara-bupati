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
            <p class="card-title">Executive Dashboard Management: Pertanian</p>
            </div>
            <p class="font-weight-500">Menampilkan hasil analisis visual dari data masuk yang pendidikan di daerah Kab. Ponorogo</p>
          </div>
        </div>
    </div>
</div>
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
            <h3 id="card-lahan">~</h3>
            <p class="text-white font-weight-500 mb-0">The total number of sessions within the date range.It is calculated as the sum . </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
    <div class="col-md-9 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title">Total Luas Lahan per Kecamatan</p>
            <p class="font-weight-500 card-caption">Menampilkan grafik jumlah siswa keseluruhan per jenjang sekolah mulai TK/PAUD, SD, SMP, SMA</p>
            <canvas id="lahan-per-kecamatan"></canvas>
          </div>
        </div>
    </div>
    <div class="col-md-3 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between">
          <p class="card-title">Daftar Kecamatan</p>
          </div>
          <p class="font-weight-500">List semua kelompok tani yang terdaftar di wilayah Ponorogo</p>
          <table class="datatable">
            <thead>
                <td>Kecamatan</td>
            </thead>
            @foreach($kecamatans as $kecamatan)
              <tr>
                <td><a href="{{ route('edm.kecamatan.index', [$kecamatan->id, 'pertanian']) }}" class="caption-with-link">{{ ucwords($kecamatan->name) }}</a></td>
              </tr>
            @endforeach
          </table>
        </div>
      </div>
  </div>
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <div class="row">
                <div class="col-sm-12">
                  <p class="card-title" style="margin-bottom: 62px">Sebaran Komoditas</p>
                  <canvas id="komoditas-lahan" style="height:200px"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    
    <div class="col-md-8 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <p class="card-title">Jumlah Kelopmok Masyarakat per Kecamatan</p>
          <p class="font-weight-500 card-caption">Menampilkan grafik jumlah siswa keseluruhan per jenjang sekolah mulai TK/PAUD, SD, SMP, SMA</p>
          <canvas id="poktan-per-kecamatan"></canvas>
        </div>
      </div>
    </div>

    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <div class="row">
                <div class="col-sm-12">
                  <p class="card-title" style="margin-bottom: 62px">Jenis Lahan</p>
                  <canvas id="jenis-lahan" style="height:200px"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="col-md-8 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <p class="card-title">Jumlah Petani per Kecamatan</p>
          <p class="font-weight-500 card-caption">Menampilkan grafik jumlah siswa keseluruhan per jenjang sekolah mulai TK/PAUD, SD, SMP, SMA</p>
          <canvas id="petani-per-kecamatan"></canvas>
        </div>
      </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
  $.get('{{ route('graph.pertanian.cards') }}', function(data){
    $('#card-komoditas').text(data[0]);
    $('#card-poktan').text(data[1]);
    $('#card-petani').text(data[2]);
    $('#card-lahan').text(data[3] + ' Ha');
  });
  $.get('{{ route('graph.pertanian.lahan-per-kecamatan') }}', function(data){
    console.log(data);
    var colnames = data.colnames;
    var values = [];
    data.values.forEach(element => {
      if (typeof element === 'string')
        values.push(parseFloat(element));
      else values.push(0);
    });
    new Chart(document.getElementById("lahan-per-kecamatan"), {
      type: 'bar',
      data: {
        labels: colnames,
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
          text: 'Chart JS Bar Chart Example'
        }
      }
    });
  });

  $.get('{{ route('graph.pertanian.jenis-lahan') }}', function(data){
    var colnames = data.colnames;
    var values = [];
    data.values.forEach(element => {
      if (typeof element === 'string')
        values.push(parseFloat(element));
      else values.push(0);
    });
    new Chart(document.getElementById("jenis-lahan"), {
      type: 'doughnut',
      data: {
        labels: colnames,
        datasets: [{
          data: data.values,
          backgroundColor: randomColors(data.colnames.length),
          hoverOffset: 4
        }]
      }}
    );
  });
  $.get('{{ route('graph.pertanian.poktan-per-kecamatan') }}', function(data){
    console.log(data);
    var colnames = data.colnames;
    var values = [];
    data.values.forEach(element => {
      if (typeof element === 'string')
        values.push(parseFloat(element));
      else values.push(0);
    });
    new Chart(document.getElementById("poktan-per-kecamatan"), {
      type: 'bar',
      data: {
        labels: colnames,
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
          text: 'Chart JS Bar Chart Example'
        }
      }
    });
  });
  $.get('{{ route('graph.pertanian.komoditas-lahan') }}', function(data){
    var colnames = data.colnames;
    var values = [];
    data.values.forEach(element => {
      if (typeof element === 'string')
        values.push(parseFloat(element));
      else values.push(0);
    });
    new Chart(document.getElementById("komoditas-lahan"), {
      type: 'doughnut',
      data: {
        labels: colnames,
        datasets: [{
          data: data.values,
          backgroundColor: randomColors(data.colnames.length),
          hoverOffset: 4
        }]
      }}
    );
  });

  $.get('{{ route('graph.pertanian.petani-per-kecamatan') }}', function(data){
    console.log(data);
    var colnames = data.colnames;
    var values = [];
    data.values.forEach(element => {
      if (typeof element === 'string')
        values.push(parseFloat(element));
      else values.push(0);
    });
    new Chart(document.getElementById("petani-per-kecamatan"), {
      type: 'bar',
      data: {
        labels: colnames,
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
          text: 'Chart JS Bar Chart Example'
        }
      }
    });
  });
</script>
@endsection