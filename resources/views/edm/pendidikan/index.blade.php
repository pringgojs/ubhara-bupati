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
            <p class="card-title">Executive Dashboard Management: Pendidikan</p>
            </div>
            <p class="font-weight-500">Menampilkan hasil analisis visual dari data masuk yang pendidikan di daerah Kab. Ponorogo</p>
          </div>
        </div>
    </div>
</div>
<div class="row">
  <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <div class="row">
                <div class="col-sm-12">
                  <p class="card-title">Statistik TK/PAUD Sederajat</p>
                </div>
                <div class="col-sm-4">
                  <img class="card-image" src="https://1.bp.blogspot.com/-YRBUcm2M9EQ/Vf5kNnmfERI/AAAAAAAADvo/6M_tXuCFGrU/s320/logo-tutwuri.png" style="width: 100%">
                </div>
                <div class="col-sm-8 card-data">
                  <h3 id="card-tk-sekolah">~</h3>
                  <p>Jumlah Sekolah</p>
                  <h3 id="card-tk-murid">~</h3>
                  <p>Total Murid</p>
                  <h3 id="card-tk-guru">~</h3>
                  <p>Total Guru</p>
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
                  <p class="card-title">Statistik SD Sederajat</p>
                </div>
                <div class="col-sm-4">
                  <img class="card-image" src="https://1.bp.blogspot.com/-dvsX_pbMPSk/YRlELQf_6PI/AAAAAAAAQBw/J1lbe6SvmCAIS0lPa8K_4bcXMslZ1YR8ACLcBGAsYHQ/s1600/logo-sekolah-dasar.png" style="width: 100%">
                </div>
                <div class="col-sm-8 card-data">
                  <h3 id="card-sd-sekolah">~</h3>
                  <p>Jumlah Sekolah</p>
                  <h3 id="card-sd-murid">~</h3>
                  <p>Total Murid</p>
                  <h3 id="card-sd-guru">~</h3>
                  <p>Total Guru</p>
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
                  <p class="card-title">Statistik SMP Sederajat</p>
                </div>
                <div class="col-sm-4">
                  <img class="card-image" src="https://www.smpn1sluke.sch.id/upload/imagecache/87436462logoosis1-800x911.jpg" style="width: 100%">
                </div>
                <div class="col-sm-8 card-data">
                  <h3 id="card-smp-sekolah">~</h3>
                  <p>Jumlah Sekolah</p>
                  <h3 id="card-smp-murid">~</h3>
                  <p>Total Murid</p>
                  <h3 id="card-smp-guru">~</h3>
                  <p>Total Guru</p>
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
                  <p class="card-title">Statistik SMA Sederajat</p>
                </div>
                <div class="col-sm-4">
                  <img class="card-image" src="https://sman1sukaresmi.sch.id/media_library/posts/post-image-1601167638481.png" style="width: 100%">
                </div>
                <div class="col-sm-8 card-data">
                  <h3 id="card-sma-sekolah">~</h3>
                  <p>Jumlah Sekolah</p>
                  <h3 id="card-sma-murid">~</h3>
                  <p>Total Murid</p>
                  <h3 id="card-sma-guru">~</h3>
                  <p>Total Guru</p>
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
            <p class="card-title">Jumlah Siswa per Kelas</p>
            <p class="font-weight-500 card-caption">Menampilkan grafik jumlah siswa keseluruhan per jenjang sekolah mulai TK/PAUD, SD, SMP, SMA</p>
            <canvas id="grafik-jenjang"></canvas>
          </div>
        </div>
    </div>
    <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <div class="row">
                <div class="col-sm-12">
                  <p class="card-title">Perbandingan Negeri dan Swasta</p>
                  <canvas id="nvs-sekolah"></canvas>
                  <p>Perbandingan Sekolah Negeri dan Swasta</p>
                  <canvas id="nvs-murid"></canvas>
                  <p>Perbandingan Murid Negeri dan Swasta</p>
                  <canvas id="nvs-guru"></canvas>
                  <p>Perbandingan Guru Negeri dan Swasta</p>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title">Perbandingan Guru:Murid per Jenjang</p>
            <p class="font-weight-500 card-caption">Menampilkan perbandingan jumlah guru dan murid per jenjang pendidikan</p>
            <div class="row" style="margin-top: 24px">
              <div class="col-sm-4">
                <img class="" src="https://1.bp.blogspot.com/-YRBUcm2M9EQ/Vf5kNnmfERI/AAAAAAAADvo/6M_tXuCFGrU/s320/logo-tutwuri.png" style="width: 100%">
              </div>
              <div class="col-sm-8" style="padding-top: 24px;">
                <h3 id="gurumurid-tk">1:30</h3>
                <p>TK/PAUD</p>
              </div>
            </div>
            <div class="row" style="margin-top: 24px">
              <div class="col-sm-4">
                <img class="" src="https://1.bp.blogspot.com/-dvsX_pbMPSk/YRlELQf_6PI/AAAAAAAAQBw/J1lbe6SvmCAIS0lPa8K_4bcXMslZ1YR8ACLcBGAsYHQ/s1600/logo-sekolah-dasar.png" style="width: 100%">
              </div>
              <div class="col-sm-8" style="padding-top: 24px;">
                <h3 id="gurumurid-sd">1:24</h3>
                <p>SD Sederajat</p>
              </div>
            </div>
            <div class="row" style="margin-top: 24px">
              <div class="col-sm-4">
                <img class="" src="https://www.smpn1sluke.sch.id/upload/imagecache/87436462logoosis1-800x911.jpg" style="width: 100%">
              </div>
              <div class="col-sm-8" style="padding-top: 24px;">
                <h3 id="gurumurid-smp">1:39</h3>
                <p>SMP Sederajat</p>
              </div>
            </div>
            <div class="row" style="margin-top: 24px">
              <div class="col-sm-4">
                <img class="" src="https://sman1sukaresmi.sch.id/media_library/posts/post-image-1601167638481.png" style="width: 100%">
              </div>
              <div class="col-sm-8" style="padding-top: 24px;">
                <h3 id="gurumurid-sma">1:38</h3>
                <p>SMA Sederajat</p>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
  $.get('{{ route('graph.pendidikan.cards') }}', function(data){
    $('#card-tk-sekolah').text(data.tk[0]);
    $('#card-tk-murid').text(data.tk[1]);
    $('#card-tk-guru').text(data.tk[2]);
    $('#card-sd-sekolah').text(data.sd[0]);
    $('#card-sd-murid').text(data.sd[1]);
    $('#card-sd-guru').text(data.sd[2]);
    $('#card-smp-sekolah').text(data.smp[0]);
    $('#card-smp-murid').text(data.smp[1]);
    $('#card-smp-guru').text(data.smp[2]);
    $('#card-sma-sekolah').text(data.sma[0]);
    $('#card-sma-murid').text(data.sma[1]);
    $('#card-sma-guru').text(data.sma[2]);
  })

  $.get('{{ route('graph.pendidikan.siswa-per-kelas') }}', function(data){
    var labelJenjang = data.colnames;
    var barColors = randomColors(data.colnames.length);
    var values = [];
    data.values.forEach(element => {
      if (typeof element === 'string')
        values.push(parseInt(element));
      else values.push(0);
    });
    var dataJenjang = values;
    new Chart(document.getElementById("grafik-jenjang"), {
      type: 'bar',
      backgroundColor: barColors,
      data: {
        labels: labelJenjang,
        datasets: [
          {
            data: dataJenjang
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
  })

  $.get('{{ route('graph.pendidikan.negeri-vs-swasta') }}', function(data){
    labels = ['Negeri', 'Swasta'];
    backgroundColor = [
          'rgb(255, 99, 132)',
          'rgb(54, 162, 235)'
        ];
    
    new Chart(document.getElementById("nvs-sekolah"), {
      type: 'doughnut',
      data: {
        labels: labels,
        datasets: [{
          data: data[0],
          backgroundColor: backgroundColor
        }], hoverOffset: 4
      }
    });
    new Chart(document.getElementById("nvs-guru"), {
      type: 'doughnut',
      data: {
        labels: labels,
        datasets: [{
          data: data[1],
          backgroundColor: backgroundColor
        }], hoverOffset: 4
      }
    });
    new Chart(document.getElementById("nvs-murid"), {
      type: 'doughnut',
      data: {
        labels: labels,
        datasets: [{
          data: data[2],
          backgroundColor: backgroundColor
        }], hoverOffset: 4
      }
    });
  })

  $.get('{{ route('graph.pendidikan.guru-vs-murid') }}', function(data){
    $('#gurumurid-tk').text(data[0]);
    $('#gurumurid-sd').text(data[1]);
    $('#gurumurid-smp').text(data[2]);
    $('#gurumurid-sma').text(data[3]);
  })
</script>
@endsection