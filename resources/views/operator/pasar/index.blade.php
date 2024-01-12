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
            <p class="card-title">Daftar Pasar</p>
            </div>
            <p class="font-weight-500">Menampilkan list yang berisi di dalam database</p>
            <table class="datatable">
                <thead>
                    <td>No.</td>
                    <td>Nama Pasar</td>
                    <td>Jenis Pasar</td>
                    <td>Deskripsi</td>
                    <td>Desa/Kelurahan</td>
                    <td>Action</td>
                </thead>
                <tbody>
                    <?php
                    $iter = 1;
                        ?>
                    @foreach($pasars as $data)
                    <tr>
                        <td>{{ $iter++ }}</td>
                        <td>{{ ucwords(strtolower($data->nama)) }}</td>
                        <td>{{ $data->jenis_pasar }}</td>
                        <td>{{ $data->deskripsi }}</td>
                        <td>
                            <button class="btn btn-primary">Desa/Kel. {{ $data->desa }}, Kec. {{ $data->kecamatan }}</button>
                        </td>
                        <td>
                            <a href="{{ url('operator/pasar', $data->id) }}/delete" class="btn" onclick="return confirm('Yakin hapus data?')"><i class="ti ti-trash"></i></a>
                            <a href="{{ url('operator/pasar', $data->id) }}/target-setoran" class="btn"><i class="ti ti-money"></i></a>
                            <button class="btn" data-toggle="modal" data-target="#ajaxModal" href="{{ url('operator/pasar',$data->id) }}/edit" onclick="openAjaxModal(this)"><i class="ti ti-pencil"></i></button>
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
            <p class="card-title">Tambah Data Pasar</p>
            <p class="font-weight-500 card-caption">Menambahkan data baru</p>
            {{ csrf_field() }}
            @include('operator.pasar.form')
          </div>
        </div>
    </div>
</div>
@endsection