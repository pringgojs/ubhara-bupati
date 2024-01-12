@extends('layouts.index')
@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
            <p class="card-title">Master Data Management: Jembatan</p>
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
            <p class="card-title">Daftar Jembatan</p>
            </div>
            <p class="font-weight-500">Menampilkan list yang berisi di dalam database</p>
            <table class="datatable">
                <thead>
                    <td>No.</td>
                    <td>Nama Jembatan</td>
                    <td>Deskripsi</td>
                    <td>Kecamatan Terlewati</td>
                    <td>Nomor</td>
                    <td>Status</td>
                    <td>Action</td>
                </thead>
                <tbody>
                    <?php
                    $iter = 1;
                        ?>
                    @foreach($jembatans as $jembatan)
                    <tr>
                        <td>{{ $iter++ }}</td>
                        <td>{{ ucwords(strtolower($jembatan->nama)) }}</td>
                        <td>{{ $jembatan->deskripsi }}</td>
                        <td>
                            @foreach($jembatan->kecamatans as $item)
                                <button class="btn btn-primary">Kecamatan {{ $item->name }}</button>
                            @endforeach
                        </td>
                        <td>{{ $jembatan->nomor }}</td>
                        <td>{{ $jembatan->status_dipakai }}</td>
                        <td>
                            <a href="{{ url('operator/infrastruktur-jembatan', $jembatan->id) }}/delete" class="btn" onclick="return confirm('Yakin hapus data?')"><i class="ti ti-trash"></i></a>
                            <button class="btn" data-toggle="modal" data-target="#ajaxModal" href="{{ url('operator/infrastruktur-jembatan',$jembatan->id) }}/edit" onclick="openAjaxModal(this)"><i class="ti ti-pencil"></i></button>
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
            <p class="card-title">Tambah Data Jembatan</p>
            <p class="font-weight-500 card-caption">Menambahkan data baru</p>
            <form method="post" action="{{ url('operator/infrastruktur-jembatan/create') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label class="col-sm-4">Nama Jembatan</label>
                    <input type="text" name="nama" class="form-control col-sm-8" placeholder="Nama Jembatan">
                </div>
                <div class="form-group row">
                    <label class="col-sm-4">Deskripsi Jembatan</label>
                    <input type="text" name="deskripsi" class="form-control col-sm-8" placeholder="Tuliskan deskripsi singkat mengenai Jembatan ini">
                </div>
                <div class="form-group row">
                    <label class="col-sm-4">Nomor</label>
                    <input type="number" name="nomor" class="form-control col-sm-8" placeholder="">
                </div>
                <div class="form-group row">
                    <label class="col-sm-4">Kecamatan</label>
                    <select class="select2 form-control col-sm-8" name="kecamatan_ids[]" multiple="multiple">
                        @foreach($kecamatans as $item)
                        <option value="{{ $item->id }}">Kecamatan {{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                @include('partials.errors')
                <input type="submit" class="form-control btn btn-success" value="Tambahkan">
            </form>
          </div>
        </div>
    </div>
</div>
@endsection