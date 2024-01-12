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
            <p class="card-title">Executive Dashboard Management: Pasar</p>
            </div>
            <p class="font-weight-500">Menampilkan hasil analisis visual dari data masuk yang pasar di daerah Kab. Ponorogo</p>
          </div>
        </div>
    </div>
</div>
<div class="row" style="margin-bottom: 32px">
  <div class="col-md-4 grid-margin grid-margin-md-0" >
    <div class="card data-icon-card-primary" style="margin-top: 24px">
      <div class="card-body">
        <p class="card-title text-white">Jumlah Pasar</p>                    
        <div class="row">
          <div class="col-12 ">
            <h3>{{ $count_pasar }}</h3>
            <p class=" font-weight-500 mb-0">The total number of sessions within the date range.It is calculated as the sum . </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4 grid-margin grid-margin-md-0" >
    <div class="card data-icon-card-primary" style="margin-top: 24px">
      <div class="card-body">
        <p class="card-title text-white">Target Total Revenue</p>                      
        <div class="row">
          <div class="col-12 text-white">
            <h3>Rp. {{ number_format($target_revenue, 2, ',','.') }}</h3>
            <p class="text-white font-weight-500 mb-0">The total number of sessions within the date range.It is calculated as the sum . </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4 grid-margin grid-margin-md-0" >
    <div class="card data-icon-card-primary" style="margin-top: 24px">
      <div class="card-body">
        <p class="card-title text-white">Current Revenue</p>                      
        <div class="row">
          <div class="col-12 text-white">
            <h3>Rp. {{ number_format($current_revenue, 2, ',','.') }}</h3>
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
              <p class="card-title" style="margin-bottom: 62px">Jenis Pasar</p>
              <canvas id="jenis-pasar" style="height: 200px"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div class="row">
            <div class="col-sm-12">
              <p class="card-title" style="margin-bottom: 62px">Market Shares</p>
              <canvas id="market-share" style="height: 200px"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between">
          <p class="card-title">Prosentase Pembayaran Pajak dan Sewa Los</p>
          </div>
          <p class="font-weight-500">Menampilkan data hasil panen semua komoditas tiap tahun</p>
          <canvas id="grafik-pembayaran"></canvas>
        </div>
      </div>
  </div>
</div>
@endsection
@section('scripts')
<script>
  var options = {
                indexAxis: 'y',
                responsive: true,
        legend: { 
          display: true,
          position: 'left'
         },
        title: {
          display: false,
        }
      };
  $.get('{{ route('graph.pasar.market-share') }}', function(data){
    new Chart(document.getElementById("market-share"), {
      type: 'doughnut',
      data: {
        labels: data.colnames,
        datasets: [
          {
            data: data.values,
            backgroundColor: randomColors(data.colnames.length),
          }
        ]
      },
      options: options
    });
  });

  $.get('{{ route('graph.pasar.jenis-pasar') }}', function(data){
    new Chart(document.getElementById("jenis-pasar"), {
      type: 'doughnut',
      data: {
        labels: data.colnames,
        datasets: [
          {
            data: data.values,
            backgroundColor: randomColors(data.colnames.length),
          }
        ]
      },
      options: options
    });
  });
  $.get('{{ route('graph.pasar.grafik-pembayaran') }}', function(data){
    new Chart($('#grafik-pembayaran'), {
		type : 'line',
          data : {
              labels :  data.colnames,
              datasets: [{
                label: 'Pembayaran Sewa Los',
                data: data.values,
                borderColor: randomColor(),
                backgroundColor: false
            }]
          },
          options : {
              title : {
                  display : false,
              },
              scales: {
                type: 'linear',
                display: true,
                position: 'left'
            }
          }
	    });
    })
</script>
@endsection