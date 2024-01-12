@extends('layouts.index')
@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
            <p class="card-title">Master Data Management: Indikator Kinerja Utama</p>
            </div>
            <p class="font-weight-500">Menampilkan data tiap master</p>
          </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
                <p class="card-title">Daftar IKU</p>
                <div class="dropdown show">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="ti ti-plus"></i>
                    </a>
                  
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <button class="btn dropdown-item" data-toggle="modal" data-target="#ajaxModal" href="{{ route('operator.iku.create') }}" onclick="openAjaxModal(this)">Indikator Kinerja Utama</button>
                        <button class="btn dropdown-item" data-toggle="modal" data-target="#ajaxModal" href="{{ route('operator.iku-group.create') }}" onclick="openAjaxModal(this)">Keterangan RPJMD</button>
                    </div>
                  </div>
                
            </div>
            <p class="font-weight-500">Menampilkan list yang berisi di dalam database</p>
            <table class="datatable">
                <thead>
                </thead>
                <tbody>
                </tbody>
            </table>
          </div>
        </div>
    </div>
</div>
@endsection