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
            <p class="card-title">Executive Dashboard Management: Infrastruktur Jalan</p>
            </div>
            <p class="font-weight-500">Menampilkan hasil analisis visual dari data masuk yang berkaitan tentang jalan di daerah Kab. Ponorogo</p>
          </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-5 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
            <p class="card-title">Rekapitulasi Kondisi Jalan</p>
            </div>
            <p class="font-weight-500">Rekapitulasi kondisi Jalan Kabupaten di Kab. Ponorogo</p>
            <canvas id="rekapitulasi-kondisi-jalan"></canvas>
            <div class="caption-with-link">
                <p>
                    <a href="{{ url('edm/infrastruktur-jalan/kondisi/baik') }}">Jalan Dengan Kondisi Baik: <span id="kondisi-jalan-baik">~</span></a>
                </p>
                <p>
                    <a href="{{ url('edm/infrastruktur-jalan/kondisi/baik') }}">Jalan Dengan Kondisi Rusak Ringan: <span id="kondisi-jalan-sedang">~</span></a>
                </p>
                <p>
                    <a href="{{ url('edm/infrastruktur-jalan/kondisi/baik') }}">Jalan Dengan Kondisi Rusak Berat: <span id="kondisi-jalan-rusakringan">~</span></a>
                </p>
                <p>
                    <a href="{{ url('edm/infrastruktur-jalan/kondisi/baik') }}">Jalan Dengan Kondisi Rusak Berat: <span id="kondisi-jalan-rusakberat">~</span></a>
                </p>
            </div>
          </div>
        </div>
    </div>
    <div class="col-md-7 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title">Daftar dan Perkembangan Jalan</p>
            <p class="font-weight-500 card-caption">Menampilkan data jalan beserta panjang dan statusnya tiap kecamatan. Data yang dihasilkan terupdate secara berkala sesuai dengan hasil survey petugas di lapangan</p>
            <table id="rekapitulasiperkecamatan"style="width: 100%">
                <thead>
                    <td>Kecamatan</td>
                    <td>Panjang Total (km)</td>
                    <td>% Kondisi Baik</td>
                    <td>% Kondisi Baik-Sedang</td>
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
            <p class="card-title">List Jalan</p>
            <p class="font-weight-500 card-caption">Menampilkan data jalan beserta panjang dan statusnya. Data yang dihasilkan terupdate secara berkala sesuai dengan hasil survey petugas di lapangan</p>
            <table id="listjalan">
                <thead>
                    <td>Nama Jalan</td>
                    <td>Kecamatan Dilalui</td>
                    <td>Paanjang (km)</td>
                    <td>% Kondisi Baik</td>
                    <td>% Kondisi Baik-Sedang</td>
                </thead>
            </table>
          </div>
        </div>
    </div>
    <div class="col-md-5 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
            <p class="card-title">Bahan Pembuatan Jalan</p>
            </div>
            <p class="font-weight-500">Menampilkan grafik perkembangan jalan dari tahun ke tahun sesuai data yang dimasukkan oleh operator</p>
            <canvas id="rekapitulasi-bahan"></canvas>
            <div class="caption-with-link">
                <p>
                    <a href="{{ url('edm/infrastruktur-jalan/kondisi/baik') }}">Jalan Dengan Bahan Aspal: <span id="bahan-aspal">~</span></a>
                </p>
                <p>
                    <a href="{{ url('edm/infrastruktur-jalan/kondisi/baik') }}">Jalan Dengan Bahan Lapen: <span id="bahan-lapen">~</span></a>
                </p>
                <p>
                    <a href="{{ url('edm/infrastruktur-jalan/kondisi/baik') }}">Jalan Dengan Bahan Rabat: <span id="bahan-rabat">~</span></a>
                </p>
                <p>
                    <a href="{{ url('edm/infrastruktur-jalan/kondisi/baik') }}">Jalan Dengan Bahan Telford: <span id="bahan-telford">~</span></a>
                </p>
                <p>
                    <a href="{{ url('edm/infrastruktur-jalan/kondisi/baik') }}">Jalan Dengan Bahan Tanah: <span id="bahan-tanah">~</span></a>
                </p>
            </div>
          </div>
        </div>
    </div>
    
</div>
@endsection
@section('scripts')
<script>
    var rekapitulasikondisijalan = null;
    var rekapitulasiperkecamatan = null;
    var rekapitulasibahan = null;
    var listjalan = null;
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
    $.get('{{ route('graph.jalan.rekapitulasi-kondisi-jalan') }}', function(data){
        rekapitulasikondisijalan = data;
        var totalpanjang = 0;
        rekapitulasikondisijalan.forEach(function(val){
            totalpanjang += val;
        })
        
        var persenbaik = parseFloat(rekapitulasikondisijalan[0] / totalpanjang *100).toFixed(2);
        var persensedang = parseFloat(rekapitulasikondisijalan[1] / totalpanjang *100).toFixed(2);
        var persenrusakringan = parseFloat(rekapitulasikondisijalan[2] / totalpanjang *100).toFixed(2);
        var persenrusakberat = parseFloat(rekapitulasikondisijalan[3] / totalpanjang *100).toFixed(2);

        $('#kondisi-jalan-baik').text(parseFloat(rekapitulasikondisijalan[0]).toFixed(2) + ' km ('+ persenbaik +'%)');
        $('#kondisi-jalan-sedang').text(parseFloat(rekapitulasikondisijalan[1]).toFixed(2) + ' km ('+ persensedang +'%)');
        $('#kondisi-jalan-rusakringan').text(parseFloat(rekapitulasikondisijalan[2]).toFixed(2) + ' km ('+ persenrusakringan +'%)');
        $('#kondisi-jalan-rusakberat').text(parseFloat(rekapitulasikondisijalan[3]).toFixed(2) + ' km ('+ persenrusakberat +'%)');
        var areaData = {
        labels: ["Kondisi Baik", "Kondisi Sedang", "Rusak Ringan", "Rusak Berat"],
        datasets: [{
            data: rekapitulasikondisijalan,
            backgroundColor: [
                "#248AFD", "#4B49AC","#FFC100", "#8A24A0", 
            ],
            borderColor: "rgba(0,0,0,0)"
            }
            ]
        };
        var rekapitulasiJalanCanvas = $("#rekapitulasi-kondisi-jalan").get(0).getContext("2d");
        var southAmericaChart = new Chart(rekapitulasiJalanCanvas, {
            type: 'doughnut',
            data: areaData,
            options: areaOptions
            });
    })
    $('#rekapitulasiperkecamatan').DataTable({
        ajax : {
            url: '{{ route('graph.jalan.rekapitulasi-perkecamatan') }}',
            dataSrc: ''},
        columns: [
            {
                mData: 'id_kecamatan',
                mRender: function(data, type, row){
                    return '<a href="{{ url('edm/kecamatan') }}/' + data + '/infrastruktur-jalan">' + row.kecamatan + '</a>';
                }
            }, 
            {data: 'panjang'},
            {data: 'persenbaik'},
            {data: 'persenbaiksedang'}
        ] 
    })
    $.get('{{ route('graph.jalan.rekapitulasi-bahan') }}', function(data){
        rekapitulasibahan = data;
        var totalpanjang = 0;
        rekapitulasibahan.forEach(function(val){
            totalpanjang += val;
        })
        
        var persenaspal = parseFloat(rekapitulasibahan[0] / totalpanjang *100).toFixed(2);
        var persenlapen = parseFloat(rekapitulasibahan[1] / totalpanjang *100).toFixed(2);
        var persenrabat = parseFloat(rekapitulasibahan[2] / totalpanjang *100).toFixed(2);
        var persentelford = parseFloat(rekapitulasibahan[3] / totalpanjang *100).toFixed(2);
        var persentanah = parseFloat(rekapitulasibahan[4] / totalpanjang *100).toFixed(2);

        $('#bahan-aspal').text(parseFloat(rekapitulasibahan[0]).toFixed(2) + ' km ('+ persenaspal +'%)');
        $('#bahan-lapen').text(parseFloat(rekapitulasibahan[1]).toFixed(2) + ' km ('+ persenlapen +'%)');
        $('#bahan-rabat').text(parseFloat(rekapitulasibahan[2]).toFixed(2) + ' km ('+ persenrabat +'%)');
        $('#bahan-telford').text(parseFloat(rekapitulasibahan[3]).toFixed(2) + ' km ('+ persentelford +'%)');
        $('#bahan-tanah').text(parseFloat(rekapitulasibahan[4]).toFixed(2) + ' km ('+ persentanah +'%)');
        var areaData = {
        labels: ['Aspal', 'Lapen', 'Rabat', 'Telford', 'Tanah'],
        datasets: [{
            data: rekapitulasikondisijalan,
            backgroundColor: [
                "#248AFD", "#4B49AC","#FFC100", "#8A24A0","#4B49AC", 
            ],
            borderColor: "rgba(0,0,0,0)"
            }
            ]
        };
        var rekapitulasiJalanCanvas = $("#rekapitulasi-bahan").get(0).getContext("2d");
        var southAmericaChart = new Chart(rekapitulasiJalanCanvas, {
            type: 'doughnut',
            data: areaData,
            options: areaOptions
            });
    })
    $.get('{{ route('graph.jalan.listjalan') }}', function(data){
        listjalan = data;
        $('#listjalan').DataTable({
            data: listjalan
        });
    })
</script>
@endsection