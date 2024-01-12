@extends('layouts.index')
@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
            <p class="card-title">Credential Management: Routing Group</p>
            </div>
            <p class="font-weight-500">Menampilkan data tiap Credential Model</p>
          </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
            <p class="card-title">Daftar Credential</p>
            </div>
            <p class="font-weight-500">Menampilkan list yang berisi di dalam database</p>
            <table class="datatable">
                <thead>
                    <td>No.</td>
                    <td>Nama Route</td>
                    <td>Menu</td>
                    <td>Group</td>
                    <td>Action</td>
                </thead>
                <tbody>
                    <?php
                    $iter = 1;
                        ?>
                    @foreach($routes as $data)
                    <tr>
                        <td>{{ $iter++ }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->menu }}</td>
                        <td>{{ $data->routing_group }}</td>
                        <td>
                          @if($data->deleteable == 1)
                            <a href="{{ url('credential/route', $data->id) }}/delete" class="btn" onclick="return confirm('Yakin hapus data?')"><i class="ti ti-trash"></i></a>
                          @endif
                            <button class="btn" data-toggle="modal" data-target="#ajaxModal" href="{{ url('credential/route',$data->id) }}/edit" onclick="openAjaxModal(this)"><i class="ti ti-pencil"></i></button>
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
            <p class="card-title">Tambah Data Routing Group</p>
            <p class="font-weight-500 card-caption">Menambahkan data baru</p>
            {{ csrf_field() }}
            @include('credential.route.form')
          </div>
        </div>
    </div>
</div>
@endsection