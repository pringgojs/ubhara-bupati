@extends('layouts.index')
@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
            <p class="card-title">Master Data Management: Fasyankes</p>
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
            <p class="card-title">Daftar Fasyankes</p>
            </div>
            <p class="font-weight-500">Menampilkan list yang berisi di dalam database</p>
            <table class="datatable">
                <thead>
                    <td>No.</td>
                    <td>Nama Fasyankes</td>
                    <td>Jenis</td>
                    <td>Poli</td>
                    <td>Action</td>
                </thead>
                <tbody>
                    <?php
                    $iter = 1;
                        ?>
                    @foreach($fasyankeses as $data)
                    <tr>
                        <td>{{ $iter++ }}</td>
                        <td>{{ ucwords(strtolower($data->nama)) }}</td>
                        <td>{{ $data->jenis_fasyankes->nama}}</td>
                        <td>
                          @foreach($data->kesehatan_polis  as $poli)
                                <button class="btn btn-primary">{{ $poli->nama }}</button>
                            @endforeach
                        </td>
                        <td>
                            {{-- <a href="{{ url('operator/kesehatan-fasyankes', $data->id) }}/delete" class="btn" onclick="return confirm('Yakin hapus data?')"><i class="ti ti-trash"></i></a> --}}
                            <button class="btn" data-toggle="modal" data-target="#ajaxModal" href="{{ url('operator/kesehatan-fasyankes',$data->id) }}/delete" onclick="openAjaxModal(this)"><i class="ti ti-trash"></i></button>
                            <button class="btn" data-toggle="modal" data-target="#ajaxModal" href="{{ url('operator/kesehatan-fasyankes',$data->id) }}/edit" onclick="openAjaxModal(this)"><i class="ti ti-pencil"></i></button>
                            <a href="{{ url('operator/kesehatan-fasyankes', $data->id) }}/nakes" class="btn" ><i class="ti ti-user"></i></a>
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
            <p class="card-title">Tambah Data Fasyankes</p>
            <p class="font-weight-500 card-caption">Menambahkan data baru</p>
            {{ csrf_field() }}
            @include('operator.kesehatan-fasyankes.form')

            @include('operator.kesehatan-fasyankes.delete')
          </div>
        </div>
    </div>
</div>
@endsection