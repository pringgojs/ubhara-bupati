<?php
$edm = true
?>
@extends('layouts.index')
@section('content')
@include('edm.desa.index')

<div class="row" style="margin-bottom: 32px">
  <div class="col-md-4 grid-margin grid-margin-md-0" >
    <div class="card data-icon-card-primary">
      <div class="card-body">
        <p class="card-title text-white">Total Pasar</p>                      
        <div class="row">
          <div class="col-12 text-white">
            <h3>40</h3>
            <p class="text-white font-weight-500 mb-0">The total number of sessions within the date range.It is calculated as the sum . </p>
          </div>
        </div>
      </div>
    </div>
    <div class="card data-icon-card-primary" style="margin-top: 24px">
      <div class="card-body">
        <p class="card-title text-white">Total Revenue</p>                      
        <div class="row">
          <div class="col-12 text-white">
            <h3>Rp. 1.944.803.100</h3>
            <p class="text-white font-weight-500 mb-0">The total number of sessions within the date range.It is calculated as the sum . </p>
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
                  <p class="card-title" style="margin-bottom: 62px">Jenis Pasar</p>
                  <canvas id="nvs-murid" style="height: 200px"></canvas>
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
                  <p class="card-title" style="margin-bottom: 62px">Kondisi Pasar</p>
                  <canvas id="nvs-guru" style="height: 200px"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
            <p class="card-title">Prosentase Pembayaran Pajak dan Sewa Los</p>
            </div>
            <p class="font-weight-500">Menampilkan data hasil panen semua komoditas tiap tahun</p>
            <canvas id="perkembangan-jalan"></canvas>
          </div>
        </div>
    </div>

    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
            <p class="card-title">List Pasar</p>
            </div>
            <p class="font-weight-500">List semua Pasar yang terdaftar di wilayah Ponorogo</p>
            <table class="datatable">
              <thead>
                  <td>No.</td>
                  <td>Nama Pasar</td>
                  <td>Alamat </td>
                  <td>Target Pendapatan Daerah Per Tahun</td>
              </thead>
                  <tr>
                    <td>1</td>
                    <td>Pasar desa {{ ucwords($desa->name) }}</td>
                    <td>{{ ucwords($desa->name) }}</td>
                    <td>Rp. {{ number_format(rand(1000000, 3000000), 0, ',','.') }}</td>
                  </tr> 
            </table>
          </div>
        </div>
    </div>

</div>
@endsection
@section('scripts')
<script>

  const data_lahan = {
    labels: [
      'Pasar Tradisional',
      'Pasar Hewan',
      'Pasar Modern',
    ],
    datasets: [{
      data: [839, 923, 213],
      backgroundColor: [
        'rgb(255, 99, 132)',
        'rgb(99, 235, 132)',
        'rgb(54, 162, 235)'
      ],
      hoverOffset: 4
    }]
  };
  const data_komoditas = {
    labels: [
      'Baik',
      'Rusak Ringan',
      'Rusak Sedang', 
      'Rusak Berat'
    ],
    datasets: [{
      data: [932, 834, 390, 813],
      backgroundColor: [
        'rgb(255, 000, 000)',
        'rgb(000, 255, 000)',
        'rgb(000, 000, 255)',
        'rgb(150, 150, 150)'
      ],
      hoverOffset: 4
    }]
  };
  const config_komoditas = {
    type: 'doughnut',
    data: data_komoditas,
  };
  const config_lahan = {
    type: 'doughnut',
    data: data_lahan,
  };
  
  new Chart(document.getElementById("nvs-guru"), config_komoditas);
  new Chart(document.getElementById("nvs-murid"), config_lahan);

        /*
        LINE CHART
        */
    const labels = ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4', 'Minggu 5'];
    const lineCanvas = $('#perkembangan-jalan');
    new Chart(lineCanvas, {
    type : 'line',
    data : {
      labels : labels,
      datasets: [
                {
                    label: 'Pajak',
                    data: [69,78,85, 89, 98],
                    borderColor: '#0ff000',
                    yAxesID: 'y',
                    fill: false
                },
                {
                    label: 'Sewa',
                    data: [40,55,70, 85, 95],
                    borderColor: '#000ff0',
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
                },
            }
    }
  });
    
</script>
@endsection