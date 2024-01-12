<?php
$edm = true
?>
@extends('layouts.index')
@section('content')
@include('edm.kecamatan.index')
<div class="row">
  <div class="col-md-3 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div class="row">
            <div class="col-sm-12">
              <div class="card-data">
                <h3 id="card-fasyankes">~</h3>
              </div>
              <p class="card-title">Fasyankes di Kab. Ponorogo</p>
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
              <div class="card-data">
                <h3 id="card-nakes">~</h3>
              </div>
              <p class="card-title">Tenaga Kesehatan di Kab. Ponorogo</p>
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
              <div class="card-data">
                <h3 id="card-peak-visitor">~</h3>
              </div>
              <p class="card-title">Peak Visitor Harian</p>
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
              <div class="card-data">
                <h3 id="card-average-visitor">~</h3>
              </div>
              <p class="card-title">Rata-Rata Pengunjung Harian per Fasyankes</p>
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
        <p class="card-title">Jenis Fasyankes</p>
        <p class="font-weight-500 card-caption">Menampilkan informasi grafik mengenai jumlah pengunjung rata-rata tiap poli dalam rentang waktu 14 hari terakhir</p>
        <canvas id="rekapitulasi-jenis-fasyankes"></canvas>
        <div id="caption-rekapitulasi-jenis-fasyankes"></div>
      </div>
    </div>
  </div>
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <p class="card-title">Persebaran Nakes</p>
        <p class="font-weight-500 card-caption">Menampilkan informasi grafik mengenai jumlah pengunjung rata-rata tiap poli dalam rentang waktu 14 hari terakhir</p>
        <canvas id="rekapitulasi-jenis-nakes"></canvas>
        <div id="caption-rekapitulasi-jenis-nakes" style="height: 200px; overflow: scroll"></div>
      </div>
    </div>
  </div>
</div>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title">Jumlah Pengunjung Per Poli</p>
            <p class="font-weight-500 card-caption">Menampilkan informasi grafik mengenai jumlah pengunjung rata-rata tiap poli dalam rentang waktu 14 hari terakhir</p>
            <canvas id="grafik-poli"></canvas>
          </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
            <p class="card-title">Jumlah Fasyankes Per Kecamatan </p>
            </div>
            <p class="font-weight-500">Menampilkan Jumlah Fasyankes tiap kecamatan yang ada di Kab. Ponorogo</p>
            <table id="list-perdesa" style="width: 100%">
              <thead>
                <tr>
                  <td>Nama Desa</td>
                  <td>Jumlah Fasyankes</td>
                </tr>
              </thead>
            </table>
          </div>
        </div>
    </div>

    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
            <p class="card-title">List Fasyankes</p>
            </div>
            <p class="font-weight-500">Menampilkan list daftar fasyankes yang ada di Kab. Ponorogo diurutkan berdasarkan rata-rata pengunjung harian</p>
            <table id="list-fasyankes">
            </table>
          </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
  
  $.get('{{ route('graph-kecamatan.kesehatan.cards', $kecamatan->id) }}', function(data){
    $('#card-fasyankes').text(data.fasyankes);
    $('#card-nakes').text(data.nakes);
    $('#card-peak-visitor').text(data.peakvisitor );
    $('#card-average-visitor').text(data.averagevisitor );
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
    $.get('{{ route('graph-kecamatan.kesehatan.jenisfasyankes', $kecamatan->id) }}', function(data){
        backColor = randomColors(data.colnames.length);
        var areaData = {
            labels: data.colnames,
            datasets: [{
                data: data.values,
                backgroundColor: backColor
                }
            ]
        };
        var rekapitulasiJalanCanvas = $("#rekapitulasi-jenis-fasyankes").get(0).getContext("2d");
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
        document.getElementById('caption-rekapitulasi-jenis-fasyankes').innerHTML =captionText;
    })
    $.get('{{ route('graph-kecamatan.kesehatan.jenisnakes', $kecamatan->id) }}', function(data){
        var rekapitulasijenisnakes = data;
        backColor = randomColors(rekapitulasijenisnakes.colnames.length);
        console.log(backColor);
        var areaData = {
            labels: rekapitulasijenisnakes.colnames,
            datasets: [{
                data: rekapitulasijenisnakes.values,
                backgroundColor: backColor
                }
            ]
        };
        var rekapitulasiJalanCanvas = $("#rekapitulasi-jenis-nakes").get(0).getContext("2d");
        var southAmericaChart = new Chart(rekapitulasiJalanCanvas, {
            type: 'doughnut',
            data: areaData,
            options: areaOptions
            });
        var captionText = '';
        for(i =0; i < rekapitulasijenisnakes.colnames.length; i++){
            if (captionText == ''){
                captionText = 'Jumlah ' + rekapitulasijenisnakes.colnames[i] + ': ' + rekapitulasijenisnakes.values[i];
            } else {
                captionText += '<br>Jumlah ' + rekapitulasijenisnakes.colnames[i] + ': ' + rekapitulasijenisnakes.values[i];
            }
        }
        document.getElementById('caption-rekapitulasi-jenis-nakes').innerHTML =captionText;
    })
    $('#list-perdesa').DataTable({
        ajax : {
            url: '{{ route('graph-kecamatan.kesehatan.fasyankesperdesa', $kecamatan->id) }}',
            dataSrc: ''},
        columns: [
            {
                mData: 'desa_id',
                mRender: function(data, type, row){
                    return '<a href="{{ url('edm/desa') }}/' + data + '/kesehatan">' + row.desa + '</a>';
                }
            }, 
            {data: 'count'},
        ] 
    })

    $.get('{{ route('graph-kecamatan.kesehatan.listfasyankes', $kecamatan->id) }}', function(data){
        listfasyankes = data;
        var titles = [];
        listfasyankes.colnames.forEach(function(colname){
            titles.push({title: colname});
        })
        $('#list-fasyankes').DataTable({
            columns: titles,
            data: listfasyankes.values
        });
    })
</script>
@endsection