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
            <p class="card-title">Executive Dashboard Management: Infrastruktur Jembatan</p>
            </div>
            <p class="font-weight-500">Menampilkan hasil analisis visual dari data masuk yang berkaitan tentang jembatan di daerah Kab. Ponorogo</p>
          </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-5 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
            <p class="card-title">Rekapitulasi Kondisi Jembatan</p>
            </div>
            <p class="font-weight-500">Rekapitulasi kondisi Jembatan Kabupaten di Kab. Ponorogo</p>
            <canvas id="rekapitulasi-kondisi-jembatan"></canvas>
            <div id="caption-rekapitulasi-kondisi-jembatan" style="margin-top: 36px;">
            </div>
          </div>
        </div>
    </div>
    <div class="col-md-7 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title">Daftar dan Perkembangan Jembatan</p>
            <p class="font-weight-500 card-caption">Menampilkan data Jembatan beserta panjang dan statusnya tiap kecamatan. Data yang dihasilkan terupdate secara berkala sesuai dengan hasil survey petugas di lapangan</p>
            <table id="rekapitulasi-perkecamatan">
                <thead>
                    <tr>
                        <th>Kecamatan</th>
                        <th>Kondisi baik</th>
                        <th>Kondisi rusak ringan</th>
                        <th>Kondisi rusak</th>
                        <th>Kondisi rusak berat</th>
                        <th>Kondisi kritis</th>
                        <th>Kondisi runtuh</th>
                    </tr>
                </thead>
            </table>
          </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-7 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title">List Jembatan</p>
            <p class="font-weight-500 card-caption">Menampilkan data Jembatan beserta panjang dan statusnya. Data yang dihasilkan terupdate secara berkala sesuai dengan hasil survey petugas di lapangan</p>
            <table id="list-jembatan">
            </table>
          </div>
        </div>
    </div>
    <div class="col-md-5 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
            <p class="card-title">Rekapitulasi Tipe Struktur</p>
            </div>
            <p class="font-weight-500">Menampilkan grafik perkembangan Jembatan dari tahun ke tahun sesuai data yang dimasukkan oleh operator</p>
            <canvas id="rekapitulasi-tipe-struktur"></canvas>
            <div id="caption-rekapitulasi-tipe-struktur" style="margin-top: 36px;">
            </div>
          </div>
        </div>
    </div>
    
</div>
@endsection
@section('scripts')
<script>
    function randomColors(count){
        let hex = ['0', '1','2','3','4','5','6','7','8','9','A','B','C','D','E','F'];
        var colors = [];
        for(i =0; i < count; i++){
            var color = '#';
            for(j = 0; j < 6; j++){
                color += hex[Math.floor(Math.random()*16)];
            }
            colors.push(color);
        }
        return colors;
    }
    var rekapitulasikondisijembatan = null;
    var rekapitulasiperkecamatan = null;
    var rekapitulasitipestruktur = null;
    var listjembatan = null;
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
    $.get('{{ route('graph.jembatan.rekapitulasi-kondisi') }}', function(data){
        rekapitulasikondisijembatan = data;
        backColor = randomColors(rekapitulasikondisijembatan.colnames.length);
        console.log(backColor);
        var areaData = {
            labels: rekapitulasikondisijembatan.colnames,
            datasets: [{
                data: rekapitulasikondisijembatan.values,
                backgroundColor: backColor
                }
            ]
        };
        var rekapitulasiJalanCanvas = $("#rekapitulasi-kondisi-jembatan").get(0).getContext("2d");
        var southAmericaChart = new Chart(rekapitulasiJalanCanvas, {
            type: 'doughnut',
            data: areaData,
            options: areaOptions
            });
        var captionText = '';
        for(i =0; i < rekapitulasikondisijembatan.colnames.length; i++){
            if (captionText == ''){
                captionText = 'Jembatan Kondisi ' + rekapitulasikondisijembatan.colnames[i] + ': ' + rekapitulasikondisijembatan.values[i];
            } else {
                captionText += '<br>Jembatan Kondisi ' + rekapitulasikondisijembatan.colnames[i] + ': ' + rekapitulasikondisijembatan.values[i];
            }
        }
        document.getElementById('caption-rekapitulasi-kondisi-jembatan').innerHTML =captionText;
    })
    $.get('{{ route('graph.jembatan.rekapitulasi-tipe-struktur') }}', function(data){
        rekapitulasitipestruktur = data;
        backColor = randomColors(rekapitulasitipestruktur.colnames.length);
        console.log(backColor);
        var areaData = {
            labels: rekapitulasitipestruktur.colnames,
            datasets: [{
                data: rekapitulasitipestruktur.values,
                backgroundColor: backColor
                }
            ]
        };
        var rekapitulasiJalanCanvas = $("#rekapitulasi-tipe-struktur").get(0).getContext("2d");
        var southAmericaChart = new Chart(rekapitulasiJalanCanvas, {
            type: 'doughnut',
            data: areaData,
            options: areaOptions
            });
        var captionText = '';
        for(i =0; i < rekapitulasitipestruktur.colnames.length; i++){
            if (captionText == ''){
                captionText = 'Jembatan Tipe Struktur ' + rekapitulasitipestruktur.colnames[i] + ': ' + rekapitulasitipestruktur.values[i];
            } else {
                captionText += '<br>Jembatan Tipe Struktur ' + rekapitulasitipestruktur.colnames[i] + ': ' + rekapitulasitipestruktur.values[i];
            }
        }
        document.getElementById('caption-rekapitulasi-tipe-struktur').innerHTML =captionText;
        
    })
    console.log('{{ route('graph.jembatan.rekapitulasi-perkecamatan') }}');
    $('#rekapitulasi-perkecamatan').DataTable({
        ajax : {
            url: '{{ route('graph.jembatan.rekapitulasi-perkecamatan') }}',
            dataSrc: ''},
        columns: [
            {
                mData: 'kecamatan_id',
                mRender: function(data, type, row){
                    return '<a href="{{ url('edm/kecamatan') }}/' + data + '/infrastruktur-jembatan">' + row.kecamatan + '</a>';
                }
            }, 
            {data: 'baik'},
            {data: 'rusakringan'},
            {data: 'rusak'},
            {data: 'rusakberat'},
            {data: 'kritis'},
            {data: 'runtuh'}
        ] 
    })
    /*
    $.get('{{ route('graph.jembatan.rekapitulasi-perkecamatan') }}', function(data){
        rekapitulasiperkecamatan = data;
        var titles = [];
        rekapitulasiperkecamatan.colnames.forEach(function(colname){
            titles.push({title: colname});
        })
        $('#rekapitulasi-perkecamatan').DataTable({
            columns: titles,
            data: rekapitulasiperkecamatan.values
        });
    })
    */
    $.get('{{ route('graph.jembatan.listjembatan') }}', function(data){
        listjembatan = data;
        var titles = [];
        listjembatan.colnames.forEach(function(colname){
            titles.push({title: colname});
        })
        $('#list-jembatan').DataTable({
            columns: titles,
            data: listjembatan.values
        });
    })
</script>
@endsection