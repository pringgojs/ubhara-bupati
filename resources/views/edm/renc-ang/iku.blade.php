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
            <p class="card-title">Executive Dashboard Management: Indikator Kinerja Utama Pemerintah Kabupaten</p>
            </div>
            <p class="font-weight-500">Menampilkan hasil analisis visual dari data masuk yang destinasi wisata di daerah Kab. Ponorogo</p>
          </div>
        </div>
    </div>
</div>
<div class="row">
  @foreach($values as $value)
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title">Grafik Analisis Aspek : {{ $value['aspek'] }}</p>
            <p class="font-weight-500 card-caption">Menampilkan Grafik Analisa Capaian untuk Aspek tertentu</p>
            <canvas id="aspek-{{ $value['id'] }}"></canvas>
          </div>
        </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <p class="card-title">Detail Informasi Aspek: {{ $value['aspek'] }}</p>
          <p class="font-weight-500 card-caption">Menampilkan informasi grafik mengenai jumlah pengunjung rata-rata tiap poli dalam rentang waktu 14 hari terakhir</p>
          <table style="width: 100%; ">
            <thead>
              <tr>
                <td>Tahun</td>
                <td>Target</td>
                <td>Capaian</td>
                <td>Satuan</td>
              </tr>
            </thead>
            <tbody>
              <?php $iter = 0?>
              @foreach($value['capaian'] as $capaian)
                <tr>
                  <td>{{ $tahuns[$iter++]['tahun'] }}
                  <td>{{ $capaian['target'] }}</td>
                  <td>{{ $capaian['capaian'] }}</td>
                  <td>{{ $capaian['satuan'] }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    @endforeach
</div>
@endsection
@section('scripts')
<script>
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
  var colnames = [];
  @foreach($tahuns as $t)
    colnames.push({{$t['tahun']}})
  @endforeach
  @foreach($values as $v)
  var capaian{{$v['id']}} = [];
  var target{{$v['id']}} = [];
    @foreach($v['capaian'] as $c)
      capaian{{$v['id']}}.push({{$c['capaian']}})
      target{{$v['id']}}.push({{$c['target']}})
    @endforeach
  const lineCanvas{{$v['id']}} = $('#aspek-{{$v['id']}}');
  new Chart(lineCanvas{{$v['id']}}, {
		type : 'line',
		data : {
			labels : colnames,
			datasets: [
                {
                    label: 'Capaian (%)',
                    data: capaian{{$v['id']}},
                    borderColor: '#00f',
                    fill: false
                },
                {
                    label: 'Target (%)',
                    data: target{{$v['id']}},
                    borderColor: '#f00',
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
                  y1: {
                      type: 'linear',
                      display: true,
                      position: 'left',
                  }
              }
		  }
	  });
  @endforeach
</script>
@endsection