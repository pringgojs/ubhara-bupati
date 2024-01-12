<?php
$edm = true
?>
@extends('layouts.index')
@section('content')
@include('edm.desa.index')

<div class="row">
    <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
            <p class="card-title">Jumlah Tempat Wisata</p>
            </div>
            <h1>89</h1> Tempat Wisata
          </div>
        </div>
    </div>
    <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
            <p class="card-title">Peak Visitor</p>
            </div>
            <h1>120</h1> pengunjung
            <p>Tempat Wisata Telaga Ngebel</p>
          </div>
        </div>
    </div>
    <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
            <p class="card-title">Peak Visitor 7 Hari Terakhir</p>
            </div>
            <h1>389</h1> pengunjung
            <p>Tempat Wisata Telaga Ngebel</p>
          </div>
        </div>
    </div>
    <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
            <p class="card-title">Hari ter-ramai</p>
            </div>
            <h1>79</h1> pengunjung
            <p>Hari Sabtu</p>
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
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
            <p class="card-title">List Tempat Wisata </p>
            </div>
            <p class="font-weight-500">Menampilkan informasi tempat wisata yang ada di Kab. Ponorogo</p>
            <table class="datatable">
              <thead>
                  <td>No.</td>
                  <td>Nama Tempat Wisata</td>
                  <td>Lokasi yang ditempati</td>
                  <td>Rata-rata Pengunjung</td>
                  <td>Peak Visitor</td>
              </thead>
              <?php $counterWisata = 1;
                  $wisatas = ['Air Terjun Coban Lawe', 'Bukit Cumbri', 'Gunung Beruk', 'Mlok Sewu', 'Gunung Bedes', 'Telaga Ngebel', 'Air Terjun Pletuk', 'Puncak Gunung Pringgitan', 'Tempat Wisata Ngembag', 'Air Terjun Widodaren', 'Tanah Goyang'];
                  $lokasis = ['Desa Krisik Kec. Pudak', 'Desa Pagerukir Kec. Sampung', 'Desa Karangpatihan Kec. Balong', 'Desa Pupus Kec. Ngebel', 'Desa Sriti Kec. Sawoo', 'Desa Gondowido Kec. Ngebel, Desa Ngebel Kec. Ngebel', '', '', '', '', '', ''];
                  $status = ['baik', 'rusak ringan', 'rusak berat'];
              ?>
              @foreach($wisatas as $wisata)
              <tr>
                  <td>{{ $counterWisata++ }}</td>
                  <td><a href="{{ url('edm/wisata/detail/id') }}?name={{$wisata}}" class="caption-with-link">{{ $wisata }}</a></td>
                  <td>{{ $lokasis[$counterWisata-2] }}</td>
                  <td>{{ rand(10,50) }}</td>
                  <td>{{ rand(50,200) }} ( {{ rand(1,29) }} Februari 2023)</td>
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

        /*
        LINE CHART
        */
    const labels = ['1 Maret 2023', '2 Maret 2023', '3 Maret 2023', '4 Maret 2023', '5 Maret 2023', '6 Maret 2023', '7 Maret 2023'];
    
    const lineCanvas = $('#perkembangan-Jembatan');
    new Chart(lineCanvas, {
		type : 'line',
		data : {
			labels : labels,
			datasets: [
                {
                    label: 'Jumlah Pengunjung',
                    data: [10, 13, 12, 15, 17, 19, 50],
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
    // var lineChart = new Chart(lineCanvas, config);
</script>
@endsection