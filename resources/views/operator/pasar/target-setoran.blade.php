@extends('layouts.index')
@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
            <p class="card-title">Master Data Management: Pasar</p>
            </div>
            <p class="font-weight-500">Menampilkan data tiap master</p>
          </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
            <p class="card-title">Target Setoran Pasar</p>
            </div>
            <p class="font-weight-500">Menampilkan list yang berisi di dalam database</p>
            <table class="datatable">
                <thead>
                    <td>No.</td>
                    <td>Tahun Anggaran</td>
                    <td>Target</td>
                    <td>Action</td>
                </thead>
                <tbody>
                    <?php
                    $iter = 1;
                        ?>
                    @foreach($targets as $data)
                    <tr>
                        <td>{{ $iter++ }}</td>
                        <td>{{ $data->tahun_anggaran }}</td>
                        <td>Rp. {{ number_format($data->target, 2, ',','.') }}</td>
                        <td>
                            <a href="{{ route('operator.setoran-pasar.delete-target', $data->id) }}" class="btn" onclick="return confirm('Yakin hapus data?')"><i class="ti ti-trash"></i></a>
                        </td>
                    @endforeach
                </tbody>
            </table>
          </div>
        </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title">Tambah Target Setoran</p>
            <p class="font-weight-500 card-caption">Menambahkan data baru</p>
            {{ csrf_field() }}
            @include('operator.pasar.form-target')
          </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
            <p class="card-title">Rekapitulasi Setoran Pasar</p>
            </div>
            <p class="font-weight-500">Menampilkan list yang berisi di dalam database</p>
            <table class="datatable">
                <thead>
                    <td>No.</td>
                    <td>Tahun Anggaran</td>
                    <td>Target</td>
                    <td>Setoran</td>
                    <td>Tanggal Setoran</td>
                    <td>Action</td>
                </thead>
                <tbody>
                    <?php
                    $iter = 1;
                        ?>
                    @foreach($setorans as $data)
                    <tr>
                        <td>{{ $iter++ }}</td>
                        <td>{{ $data->tahun_anggaran }}</td>
                        <td>Rp. {{ number_format($data->target, 2, ',','.') }}</td>
                        <td>Rp. {{ number_format($data->setoran_terkumpul, 2, ',','.') }}</td>
                        <td>{{ date('d-m-Y', strtotime($data->tanggal_data) )}}</td>
                        <td>
                          <a href="{{ route('operator.setoran-pasar.delete-setoran', $data->id) }}" class="btn" onclick="return confirm('Yakin hapus data?')"><i class="ti ti-trash"></i></a>
                        </td>
                    @endforeach
                </tbody>
            </table>
          </div>
        </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title">Tambah Target Setoran</p>
            <p class="font-weight-500 card-caption">Menambahkan data baru</p>
            {{ csrf_field() }}
            @include('operator.pasar.form-setoran')
          </div>
        </div>
    </div>
</div>
@endsection