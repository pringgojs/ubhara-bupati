@extends('layouts.index')
@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
            <p class="card-title">Master Data Management: Desa</p>
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
            <p class="card-title">Daftar Desa</p>
            </div>
            <p class="font-weight-500">Menampilkan list yang berisi di dalam database</p>
            <table class="datatable">
                <thead>
                    <td>Nama Desa/Lurah</td>
                    <td>Kecamatan </td>
                    <td>Nama Kepala Desa/Lurah</td>
                    <td>Action</td>
                </thead>
                <tbody>
                    @foreach($desas as $desa)
                    <tr>
                        <td>{{ ucwords(strtolower($desa->name)) }}</td>
                        <td>{{ ucwords($desa->kecamatan) }}</td>
                        <td>{{ $desa->lurah }}</td>
                        <td>
                            <a href="{{ url('operator/desa', $desa->id) }}/delete" class="btn" onclick="return confirm('Yakin hapus data?')"><i class="ti ti-trash"></i></a>
                            <button class="btn" data-toggle="modal" data-target="#ajaxModal" href="{{ url('operator/desa',$desa->id) }}/edit" onclick="openAjaxModal(this)"><i class="ti ti-pencil"></i></button>
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
            <p class="card-title">Tambah Desa Baru</p>
            <p class="font-weight-500 card-caption">Menambahkan data baru</p>
            <form method="post" action="{{ url('operator/desa/create') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label class="col-sm-4">Nama Desa</label>
                    <input type="text" name="name" class="form-control col-sm-8" placeholder="Nama Desa">
                </div>
                <div class="form-group row">
                    <label class="col-sm-4">Kecamatan</label>
                    <select class="select2 form-control col-sm-8" name="kecamatan_id">
                        @foreach($kecamatans as $kecamatan)
                        <option value="{{ $kecamatan->id }}">Kecamatan {{ $kecamatan->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4">Luas Desa</label>
                    <input type="number" name="luas" class="form-control col-sm-8" placeholder="km persegi">
                </div>
                <div class="form-group row">
                    <label class="col-sm-4">Nama Kepala Desa/Lurah</label>
                    <input type="text" name="lurah" class="form-control col-sm-8" placeholder="Nama Lurah">
                </div>
                <div class="form-group row">
                    <label class="col-sm-4">Alamat Kepala Desa/Lurah</label>
                    <input type="text" name="alamat_lurah" class="form-control col-sm-8" placeholder="Alamat Kepala Desa/Lurah">
                </div>
                <div class="form-group row">
                    <label class="col-sm-4">Telp Kepala Desa/Lurah</label>
                    <input type="text" name="telp_lurah" class="form-control col-sm-8" placeholder="08123456789">
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