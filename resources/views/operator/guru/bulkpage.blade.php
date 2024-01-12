@extends('layouts.index')
@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
            <p class="card-title">Master Data Management: Guru</p>
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
                  <td>Nama File</td>
                  <td>Tanggal data</td>
                  <td>Status</td>
                  <td>Action</td>
              </thead>
              <tbody>
                  <?php
                  $iter = 1;
                      ?>
                  @foreach($files as $data)
                  <tr>
                      <td>{{ $iter++ }}</td>
                      <td>{{ $data->name }}</td>
                      <td>{{ $data->tanggal_data }}</td>
                      <td>{{ $data->status }}</td>
                      <td>
                        @if($data->status == 'uploaded')
                        <a href="{{ route('operator.guru.bulkvalidate', $data->id) }}" class="btn" data-toggle="tooltip" title="Migrate"><i class="ti ti-check"></i></a>
                        @endif
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
            <p class="card-title">Tambah Data Guru Sekaligus</p>
            <p class="font-weight-500 card-caption">Menambahkan data baru</p>
            <a href="{{ url('file_upload/Pendidik.xlsx') }}">
              <button class="btn btn-sm btn-primary">Download Contoh File Guru</button>
            </a>
            <hr>
            <form method="post" action="{{ url('operator/guru/bulk') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-grup row">
                  <label class="col-sm-4">Tanggal Update</label>
                  <input type="date" class="form-control col-sm-8" name="tanggal_data">
                </div>
                <div class="form-group row">
                    <label class="col-sm-4">File</label>
                    <input type="file" name="file" class="form-control col-sm-8" placeholder="File Data">
                </div>
                @include('partials.errors')
                <input type="submit" class="form-control btn btn-success" value="Tambahkan">
            </form>
          </div>
        </div>
    </div>
</div>
@endsection