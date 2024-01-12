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
                  <canvas id="nvs-0"></canvas>
                  <p>Perbandingan Sekolah Negeri dan Swasta</p>
                  <canvas id="nvs-1"></canvas>
                  <p>Perbandingan Murid Negeri dan Swasta</p>
                  <canvas id="nvs-2"></canvas>
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
                <h3 id="card-perbandingan-tk">~</h3>
                <p>TK/PAUD</p>
              </div>
            </div>
            <div class="row" style="margin-top: 24px">
              <div class="col-sm-4">
                <img class="" src="https://1.bp.blogspot.com/-dvsX_pbMPSk/YRlELQf_6PI/AAAAAAAAQBw/J1lbe6SvmCAIS0lPa8K_4bcXMslZ1YR8ACLcBGAsYHQ/s1600/logo-sekolah-dasar.png" style="width: 100%">
              </div>
              <div class="col-sm-8" style="padding-top: 24px;">
                <h3 id="card-perbandingan-sd">~</h3>
                <p>SD Sederajat</p>
              </div>
            </div>
            <div class="row" style="margin-top: 24px">
              <div class="col-sm-4">
                <img class="" src="https://www.smpn1sluke.sch.id/upload/imagecache/87436462logoosis1-800x911.jpg" style="width: 100%">
              </div>
              <div class="col-sm-8" style="padding-top: 24px;">
                <h3 id="card-perbandingan-smp">~</h3>
                <p>SMP Sederajat</p>
              </div>
            </div>
            <div class="row" style="margin-top: 24px">
              <div class="col-sm-4">
                <img class="" src="https://sman1sukaresmi.sch.id/media_library/posts/post-image-1601167638481.png" style="width: 100%">
              </div>
              <div class="col-sm-8" style="padding-top: 24px;">
                <h3 id="card-perbandingan-sma">~</h3>
                <p>SMA Sederajat</p>
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
            <p class="card-title">List TK/PAUD Terpopuler </p>
            </div>
            <p class="font-weight-500">Menampilkan daftar semua TK/PAUD diurutkan berdasarkan jumlah muridnya</p>
            <table id="list-tk">
              <thead>
                  <td>Nama Sekolah</td>
                  <td>Desa</td>
                  <td>Kecamatan</td>
                  <td>Jenjang</td>
                </thead>
            </table>
          </div>
        </div>
    </div>

    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
            <p class="card-title">List SD Sederajat Terpopuler </p>
            </div>
            <p class="font-weight-500">Menampilkan daftar semua SD dan Sederajat diurutkan berdasarkan jumlah muridnya</p>
            <table id="list-sd">
              <thead>
                  <td>Nama Sekolah</td>
                  <td>Desa</td>
                  <td>Kecamatan</td>
                  <td>Jenjang</td>
                </thead>
            </table>
          </div>
        </div>
    </div>

    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
            <p class="card-title">List SMP Sederajat Terpopuler </p>
            </div>
            <p class="font-weight-500">Menampilkan daftar semua SMP Sederajat diurutkan berdasarkan jumlah muridnya</p>
            <table id="list-smp">
              <thead>
                  <td>Nama Sekolah</td>
                  <td>Desa</td>
                  <td>Kecamatan</td>
                  <td>Jenjang</td>
                </thead>
            </table>
          </div>
        </div>
    </div>

    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
            <p class="card-title">List SMA Sederajat Terpopuler </p>
            </div>
            <p class="font-weight-500">Menampilkan daftar semua SMA Sederajat diurutkan berdasarkan jumlah muridnya</p>
            <table id="list-sma">
              <thead>
                  <td>Nama Sekolah</td>
                  <td>Desa</td>
                  <td>Kecamatan</td>
                  <td>Jenjang</td>
                </thead>
            </table>
          </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
  $.get('{{ route('graph-desa.pendidikan.cards', $desa->id) }}', function(data){
    $('#card-tk-guru').text('text')
    $('#card-tk-guru').text(data.gurus[0].tk);
    $('#card-tk-murid').text(data.murids[0].tk);
    $('#card-tk-sekolah').text(data.sekolahs[0].tk);

    $('#card-sd-guru').text(data.gurus[1].sd);
    $('#card-sd-murid').text(data.murids[1].sd);
    $('#card-sd-sekolah').text(data.sekolahs[1].sd);

    $('#card-smp-guru').text(data.gurus[2].smp);
    $('#card-smp-murid').text(data.murids[2].smp);
    $('#card-smp-sekolah').text(data.sekolahs[2].smp);

    $('#card-sma-guru').text(data.gurus[3].sma);
    $('#card-sma-murid').text(data.murids[3].sma);
    $('#card-sma-sekolah').text(data.sekolahs[3].sma);
  })

  $.get('{{ route('graph-desa.pendidikan.siswa-per-kelas', $desa->id) }}', function(data){
    new Chart(document.getElementById("grafik-jenjang"), {
      type: 'bar',
      data: {
        labels: data.colnames,
        datasets: [
          {
            data: data.values
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
  })

  $.get('{{ route('graph-desa.pendidikan.negeri-vs-swasta', $desa->id) }}', function(data){
    for(i = 0; i < data.length; i++){
      const data_nvs = {
        labels: [
          'Negeri',
          'Swasta'
        ],
        datasets: [{
          data: data[i],
          backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)'
          ],
          hoverOffset: 4
        }]
      };
      new Chart(document.getElementById("nvs-" + i), {
        type: 'doughnut',
        data: data_nvs,
      });
    }
  })

  $.get('{{ route('graph-desa.pendidikan.guru-vs-murid', $desa->id) }}', function(data){
    $('#card-perbandingan-tk').text(data[0]);
    $('#card-perbandingan-sd').text(data[1]);
    $('#card-perbandingan-smp').text(data[2]);
    $('#card-perbandingan-sma').text(data[3]);
  })

  $.get('{{ route('graph-desa.pendidikan.list-sekolah', $desa->id) }}', function(data){
    for(var key in data){
      $('#list-' + key).DataTable({
          data: data[key]
      });
    }        
  })
</script>
@endsection