@extends('layouts.index')
@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
            <p class="card-title">Master Data Management: Kelompok Masyarakat Tani</p>
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
            <p class="card-title">Daftar Kelompok Masyarakat Tani</p>
            </div>
            <p class="font-weight-500">Menampilkan list yang berisi di dalam database</p>
            <table class="datatable">
                <thead>
                    <td>No.</td>
                    <td>Nama Kelompok Masyarakat Tani</td>
                    <td>Ketua</td>
                    <td>Alamat</td>
                    <td>Action</td>
                </thead>
                <tbody>
                    <?php
                    $iter = 1;
                        ?>
                    @foreach($kmts as $data)
                    <tr>
                        <td>{{ $iter++ }}</td>
                        <td>{{ ucwords(strtolower($data->nama)) }}</td>
                        <td>{{ $data->ketua }}</td>
                        <td>Desa/Kel. {{ $data->desa }}, Kec. {{ $data->kecamatan }}
                        </td>
                        <td>
                            <a href="{{ url('operator/kelompok-masyarakat-tani', $data->id) }}/delete" class="btn" onclick="return confirm('Yakin hapus data?')"><i class="ti ti-trash"></i></a>
                            <a href="{{ url('operator/kelompok-masyarakat-tani', $data->id) }}/anggota" class="btn"><i class="ti ti-eye"></i></a>
                            <button class="btn" data-toggle="modal" data-target="#ajaxModal" href="{{ url('operator/kelompok-masyarakat-tani',$data->id) }}/edit" onclick="openAjaxModal(this)"><i class="ti ti-pencil"></i></button>
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
            <p class="card-title">Tambah Data Kelompok Masyarakat Tani</p>
            <p class="font-weight-500 card-caption">Menambahkan data baru</p>
            {{ csrf_field() }}
            @include('operator.kelompok-masyarakat-tani.form')
          </div>
        </div>
    </div>
</div>
@endsection