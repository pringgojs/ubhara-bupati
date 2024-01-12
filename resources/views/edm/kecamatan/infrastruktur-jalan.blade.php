<?php
$edm = true
?>
@extends('layouts.index')
@section('content')
@include('edm.kecamatan.index')
<div class="row" style="margin-bottom: 32px">
  <div class="col-md-3 stretch-card grid-margin grid-margin-md-0">
    <div class="card data-icon-card-primary">
      <div class="card-body">
        <p class="card-title text-white">Total Jalan Kabupaten</p>                      
        <div class="row">
          <div class="col-12 text-white">
            <h3 id="card-ruas">~ruas</h3>
            <p class="text-white font-weight-500 mb-0">The total number of sessions within the date range.It is calculated as the sum . </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3 stretch-card grid-margin grid-margin-md-0">
    <div class="card data-icon-card-primary">
      <div class="card-body">
        <p class="card-title text-white">Total Panjang Jalan Kabupaten</p>                      
        <div class="row">
          <div class="col-12 text-white">
            <h3 id="card-panjang">~km</h3>
            <p class="text-white font-weight-500 mb-0">The total number of sessions within the date range.It is calculated as the sum . </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3 stretch-card grid-margin grid-margin-md-0">
    <div class="card data-icon-card-primary">
      <div class="card-body">
        <p class="card-title text-white">Prosentase Jalan Kabupaten Berstatus Baik</p>                      
        <div class="row">
          <div class="col-12 text-white">
            <h3 id="card-prosentasebaik">~</h3>
            <p class="text-white font-weight-500 mb-0">The total number of sessions within the date range.It is calculated as the sum . </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3 stretch-card grid-margin grid-margin-md-0">
    <div class="card data-icon-card-primary">
      <div class="card-body">
        <p class="card-title text-white">Total Desa</p>                      
        <div class="row">
          <div class="col-12 text-white">
            <h3>{{ count($desas) }} desa</h3>
            <p class="text-white font-weight-500 mb-0">The total number of sessions within the date range.It is calculated as the sum . </p>
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
              <p class="card-title">Kondisi Jalan</p>
              <canvas id="rekapitulasi-kondisi-jalan"></canvas>
              <div class="caption-with-link">
                  <p>
                      <a>Jalan Dengan Kondisi Baik: <span id="kondisi-jalan-baik">~</span></a>
                  </p>
                  <p>
                      <a>Jalan Dengan Kondisi Rusak Ringan: <span id="kondisi-jalan-sedang">~</span></a>
                  </p>
                  <p>
                      <a>Jalan Dengan Kondisi Rusak Berat: <span id="kondisi-jalan-rusakringan">~</span></a>
                  </p>
                  <p>
                      <a>Jalan Dengan Kondisi Rusak Berat: <span id="kondisi-jalan-rusakberat">~</span></a>
                  </p>
              </div>
            </div>
        </div>
    </div>
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between">
        <p class="card-title">Bahan Pembuatan Jalan</p>
        </div>
        <p class="font-weight-500">Menampilkan grafik perkembangan jalan dari tahun ke tahun sesuai data yang dimasukkan oleh operator</p>
        <canvas id="rekapitulasi-bahan"></canvas>
        <div class="caption-with-link">
            <p>
                <a>Jalan Dengan Bahan Aspal: <span id="bahan-aspal">~</span></a>
            </p>
            <p>
                <a>Jalan Dengan Bahan Lapen: <span id="bahan-lapen">~</span></a>
            </p>
            <p>
                <a>Jalan Dengan Bahan Rabat: <span id="bahan-rabat">~</span></a>
            </p>
            <p>
                <a>Jalan Dengan Bahan Telford: <span id="bahan-telford">~</span></a>
            </p>
            <p>
                <a>Jalan Dengan Bahan Tanah: <span id="bahan-tanah">~</span></a>
            </p>
        </div>
      </div>
    </div>
</div>
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body"> 
          <p class="card-title">List Jalan Kabupaten</p>
          <table id="listjalan">
            <thead>
                <td>nama</td>
                <td>panjang (km)</td>
                <td>bahan aspal (km)</td>
                <td>bahan lapen (km)</td>
                <td>bahan rabat (km)</td>
                <td>bahan telford (km)</td>
                <td>bahan tanah (km)</td>
                <td>kondisi baik (km)</td>
                <td>kondisi sedang (km)</td>
                <td>kondisi rusakringan (km)</td>
                <td>kondisi rusakberat (km)</td>
            </thead>
        </table>
        </div>
    </div>
  </div>
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
      },
    }
  $.get('{{ route('graph-kecamatan.jalan.cards', $kecamatan->id) }}', function(data){
    console.log(data);
    $('#card-ruas').text(data.jumlah_ruas + ' ruas');
    $('#card-panjang').text(data.totalPanjang + ' km');
    $('#card-prosentasebaik').text(data.jalan_baik + ' %');
  })

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

  $.get('{{ route('graph-kecamatan.jalan.rekapitulasi-bahan', $kecamatan->id) }}', function(data){
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
            data: rekapitulasibahan,
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

    $.get('{{ route('graph-kecamatan.jalan.listjalan', $kecamatan->id) }}', function(data){
        listjalan = data;
        $('#listjalan').DataTable({
            data: listjalan
        });
    })
</script>
@endsection