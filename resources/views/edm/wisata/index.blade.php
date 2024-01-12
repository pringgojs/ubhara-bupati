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
            <p class="card-title">Executive Dashboard Management: Wisata</p>
            </div>
            <p class="font-weight-500">Menampilkan hasil analisis visual dari data masuk yang destinasi wisata di daerah Kab. Ponorogo</p>
          </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
            <p class="card-title">Jumlah Tempat Wisata</p>
            </div>
            <h1 id="card-tempat">~</h1> Tempat Wisata
          </div>
        </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
            <p class="card-title">Total Visitor</p>
            </div>
            <h1 id="card-pengunjung">~</h1> pengunjung
          </div>
        </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
            <p class="card-title">Peak Visitor 7 Hari Terakhir</p>
            </div>
            <h1 id="card-peak-visitor">~</h1> pengunjung
            <p id="card-peak-visitor-lokasi">Tempat Wisata Telaga Ngebel</p>
          </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title">Grafik Pengunjung</p>
            <p class="font-weight-500 card-caption">Menampilkan pengunjung tempat wisata secara keseluruhan per hari</p>
            <canvas id="perkembangan-Jembatan"></canvas>
          </div>
        </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <p class="card-title">Sebaran Pengunjung</p>
          <p class="font-weight-500 card-caption">Menampilkan informasi grafik mengenai jumlah pengunjung rata-rata tiap poli dalam rentang waktu 14 hari terakhir</p>
          <canvas id="market-shares"></canvas>
          <div id="caption-market-shares" style="height: 200px; overflow: scroll"></div>
        </div>
      </div>
    </div>
    <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <p class="card-title">Grafik Pengunjung Bulanan</p>
          <p class="font-weight-500 card-caption">Menampilkan pengunjung tempat wisata secara keseluruhan per hari</p>
          <canvas id="monthly-recap"></canvas>
        </div>
      </div>
    </div>
    <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <p class="card-title">Grafik Pengunjung Tahunan</p>
          <p class="font-weight-500 card-caption">Menampilkan pengunjung tempat wisata secara keseluruhan per hari</p>
          <canvas id="yearly-recap"></canvas>
        </div>
      </div>
    </div>
    <div class="col-md-7 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <p class="card-title">Tempat Wisata Trending</p>
          <p class="font-weight-500 card-caption">Tempat Wisata yang dikunjungi banyak orang akhir-akhir ini</p>
          <div class="row">
            <div class="col-md-12">
              <img src="https://lh3.googleusercontent.com/p/AF1QipNraRuwe_aqJiXJDn62m2YBSKBYull4fjxrIxxv=s680-w680-h510" style="width: 100%; margin-bottom: 12px">
              <span style="font-size: 24px">Telaga Ngebel </span><i class="ti-crown text-primary"></i><span> 80 Pengunjung</span>
            </div>
          </div>
          <div class="row wisata-top">
            <img src="https://lh3.googleusercontent.com/p/AF1QipPpqfkoU3BmHJYc6xg8r2dLA1YCtUA96HR0tfjs=s680-w680-h510" class="col-sm-4">
            <div class="col-sm-8">
              <p style="font-size: 18px">Bukit Cumbri</p>
              <p>50 Pengunjung</p>
            </div>
        </div>
          <div class="row wisata-top">
            <img src="https://lh3.googleusercontent.com/p/AF1QipM644_1nZDbnCp1hZh2hPAm7fa4vJLTXhp8xYif=s680-w680-h510" class="col-sm-4">
            <div class="col-sm-8">
              <p style="font-size: 18px">Taman Wengker</p>
              <p>30 Pengunjung</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-5 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
            <p class="card-title">List Tempat Wisata </p>
            </div>
            <p class="font-weight-500">Menampilkan informasi tempat wisata yang ada di Kab. Ponorogo</p>
            <table id="list-wisata">
              <thead>
                  <td>Nama Tempat Wisata</td>
                  <td>Desa</td>
                  <td>Total Pengunjung</td>
              </thead>
            </table>
          </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
  $.get('{{ route('graph.wisata.cards') }}', function(data){
    console.log(data);
    $('#card-tempat').text(data.jumlah_wisata);
    $('#card-pengunjung').text(data.total_visitor);
    $('#card-peak-visitor').text(data.peak_visitor.visitor);
    $('#card-peak-visitor-lokasi').text(data.peak_visitor.wisata);
  })
  $.get('{{ route('graph.wisata.kunjungan') }}', function(data){
    const lineCanvas = $('#perkembangan-Jembatan');
    new Chart(lineCanvas, {
		type : 'line',
		data : {
			labels : data.colnames,
			datasets: [
                {
                    label: 'Jumlah Pengunjung',
                    data: data.values,
                    borderColor: '#00f',
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
  })
  $.get('{{ route('graph.wisata.monthly-recap') }}', function(data){
    const lineCanvas = $('#monthly-recap');
    new Chart(lineCanvas, {
		type : 'line',
		data : {
			labels : data.colnames,
			datasets: [
                {
                    label: 'Jumlah Pengunjung',
                    data: data.values,
                    borderColor: '#00f',
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
  })
  $.get('{{ route('graph.wisata.yearly-recap') }}', function(data){
    const lineCanvas = $('#yearly-recap');
    new Chart(lineCanvas, {
		type : 'line',
		data : {
			labels : data.colnames,
			datasets: [
                {
                    label: 'Jumlah Pengunjung',
                    data: data.values,
                    borderColor: '#00f',
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
    }
  }
  $.get('{{ route('graph.wisata.market-shares') }}', function(data){
        backColor = randomColors(data.colnames.length);
        var areaData = {
            labels: data.colnames,
            datasets: [{
                data: data.values,
                backgroundColor: backColor
                }
            ]
        };
        var rekapitulasiJalanCanvas = $("#market-shares").get(0).getContext("2d");
        var southAmericaChart = new Chart(rekapitulasiJalanCanvas, {
            type: 'doughnut',
            data: areaData,
            options: areaOptions
            });
        var captionText = '';
        for(i =0; i < data.colnames.length; i++){
            if (captionText == ''){
                captionText = 'Jumlah ' + data.colnames[i] + ': ' + data.values[i];
            } else {
                captionText += '<br>Jumlah ' + data.colnames[i] + ': ' + data.values[i];
            }
        }
        document.getElementById('caption-market-shares').innerHTML =captionText;
    })
    $('#list-wisata').DataTable({
        ajax : {
            url: '{{ route('graph.wisata.list') }}',
            dataSrc: ''},
        columns: [
            {
                mData: 'tempat_wisata_id',
                mRender: function(data, type, row){
                    return '<a >'+ row.nama + '</a>';
                }
            }, 
            {data: 'alamat'},
            {data: 'pengunjung'},
        ] 
    })
</script>
@endsection