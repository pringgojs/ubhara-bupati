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
        <p class="card-title text-white">Total Jembatan</p>                      
        <div class="row">
          <div class="col-12 text-white">
            <h3 id="card-jumlah">~ Jembatan</h3>
            <p class="text-white font-weight-500 mb-0">The total number of sessions within the date range.It is calculated as the sum . </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3 stretch-card grid-margin grid-margin-md-0">
    <div class="card data-icon-card-primary">
      <div class="card-body">
        <p class="card-title text-white">Total Panjang Jembatan</p>
        <div class="row">
          <div class="col-12 text-white">
            <h3 id="card-panjang">~ meter</h3>
            <p class="text-white font-weight-500 mb-0">The total number of sessions within the date range.It is calculated as the sum . </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3 stretch-card grid-margin grid-margin-md-0">
    <div class="card data-icon-card-primary">
      <div class="card-body">
        <p class="card-title text-white">Prosentase Jembatan Berstatus Baik</p>
        <div class="row">
          <div class="col-12 text-white">
            <h3 id="card-prosentasebaik">%</h3>
            <p class="text-white font-weight-500 mb-0">The total number of sessions within the date range.It is calculated as the sum . </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3 stretch-card grid-margin grid-margin-md-0">
    <div class="card data-icon-card-primary">
      <div class="card-body">
        <p class="card-title text-white">Total Desa</p>                      
        <div class="row">
          <div class="col-12 text-white">
            <h3>{{ count($desas) }} desa</h3>
            <p class="text-white font-weight-500 mb-0">The total number of sessions within the date range.It is calculated as the sum . </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
    <div class="col-md-5 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
              <p class="card-title">Kondisi Jembatan</p>
              <canvas id="kondisi-jembatan"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-5 grid-margin stretch-card">
      <div class="card">
          <div class="card-body">
            <p class="card-title">Tipe Struktur Jembatan</p>

            <canvas id="rekap-struktur"></canvas>
          </div>
      </div>
  </div>
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body"> 
            <p class="card-title">List Jembatan</p>
            <p class="font-weight-500 card-caption">Menampilkan data Jembatan beserta panjang dan statusnya. Data yang dihasilkan terupdate secara berkala sesuai dengan hasil survey petugas di lapangan</p>
            <table id="listjembatan">
                <thead>
                    <td>No. Urut Jembatan</td>
                    <td>Nama Jembatan</td>
                    <td>PAL KM</td>
                    <td>Tipe Struktur</td>
                    <td>Panjang (m)</td>
                    <td>Lebar Jalur (m)</td>
                    <td>Lebar Total (m)</td>
                    <td>Kondisi</td>
                </thead>
            </table>
        </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script>
  $.get('{{ route('graph-kecamatan.jembatan.cards', $kecamatan->id) }}', function(data){
    $('#card-jumlah').text(data.jumlah_jembatan + ' jembatan');
    $('#card-panjang').text(data.total_panjang + ' m');
    $('#card-prosentasebaik').text(data.jumlah_baik + ' %');
  })

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
  $.get('{{ route('graph-kecamatan.jembatan.rekapitulasi-kondisi-jembatan', $kecamatan->id) }}', function(data){
        var areaData = {
        labels: data.colnames,
        datasets: [{
            data: data.values,
            backgroundColor: randomColors(data.colnames.Length),
            }]
        };
        var kjCanvas = $("#kondisi-jembatan").get(0).getContext("2d");
        var southAmericaChart = new Chart(kjCanvas, {
            type: 'doughnut',
            data: areaData,
            options: areaOptions
            });
    })

  $.get('{{ route('graph-kecamatan.jembatan.rekapitulasi-struktur', $kecamatan->id) }}', function(data){
    console.log(data);
        var areaData = {
        labels: data.colnames,
        datasets: [{
            data: data.values,
            backgroundColor: randomColors(data.colnames.Length),
            }]
        };
        var kjCanvas = $("#rekap-struktur").get(0).getContext("2d");
        var southAmericaChart = new Chart(kjCanvas, {
            type: 'doughnut',
            data: areaData,
            options: areaOptions
            });
    })

  $.get('{{ route('graph-kecamatan.jembatan.listjembatan', $kecamatan->id) }}', function(data){
        $('#listjembatan').DataTable({
            data: data
        });
    })
</script>
@endsection