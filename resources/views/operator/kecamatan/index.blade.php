@extends('layouts.index')
@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
            <p class="card-title">Master Data Management: Kecamatan</p>
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
            <p class="card-title">Daftar Kecamatan</p>
            </div>
            <p class="font-weight-500">Menampilkan list yang berisi di dalam database</p>
            <table class="datatable">
                <thead>
                    <td>Nama Kecamatan</td>
                    <td>Luas Wilayah Camat </td>
                    <td>Nama Camat </td>
                    <td>Jumlah Desa/Kelurahan</td>
                    <td>Action</td>
                </thead>
                <tbody>
                    @foreach($kecamatans as $kecamatan)
                    <tr>
                        <td>{{ ucwords($kecamatan->name) }}</td>
                        <td>{{ $kecamatan->luas }} km<sup>2</sup></td>
                        <td>{{ $kecamatan->camat }}</td>
                        <td>{{ $kecamatan->desa->count() }}</td>
                        <td>
                            <a href="{{ url('operator/kecamatan', $kecamatan->id) }}/delete" class="btn" onclick="return confirm('Yakin hapus data?')"><i class="ti ti-trash"></i></a>
                            <button class="btn" data-toggle="modal" data-target="#ajaxModal" href="{{ url('operator/kecamatan',$kecamatan->id) }}/edit" onclick="openAjaxModal(this)"><i class="ti ti-pencil"></i></button>
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
            <p class="card-title">Tambah Kecamatan Baru</p>
            <p class="font-weight-500 card-caption">Menambahkan data baru</p>
            <form method="post" action="{{ url('operator/kecamatan/create') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label class="col-sm-4">Nama Kecamatan</label>
                    <input type="text" name="name" class="form-control col-sm-8" placeholder="Nama Kecamatan">
                </div>
                <div class="form-group row">
                    <label class="col-sm-4">Luas Kecamatan</label>
                    <input type="number" name="luas" class="form-control col-sm-8" placeholder="km persegi">
                </div>
                <div class="form-group row">
                    <label class="col-sm-4">Nama Camat</label>
                    <input type="text" name="camat" class="form-control col-sm-8" placeholder="Nama Camat">
                </div>
                <div class="form-group row">
                    <label class="col-sm-4">NIP Camat</label>
                    <input type="text" name="nip" class="form-control col-sm-8" placeholder="19450817 200008 1 001">
                </div>
                <div class="form-group row">
                    <label class="col-sm-4">Alamat Camat</label>
                    <input type="text" name="alamat_camat" class="form-control col-sm-8" placeholder="Alamat Camat">
                </div>
                <div class="form-group row">
                    <label class="col-sm-4">Telp Camat</label>
                    <input type="text" name="telp_camat" class="form-control col-sm-8" placeholder="08123456789">
                </div>
                <!--div class="form-group row">
                    <label class="col-sm-4">Foto Wilayah</label>
                    <input type="file" name="foto" class="form-control col-sm-8" placeholder="Foto Wilayah">
                </div-->
                @include('partials.errors')
                <input type="submit" class="form-control btn btn-success" value="Tambahkan">
            </form>
          </div>
        </div>
    </div>
</div>
@endsection