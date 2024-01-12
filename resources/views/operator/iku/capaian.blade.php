@if(isset($capaian))
<form method="post" action="{{ route('operator.capaian-iku.update', $capaian->id) }}" enctype="multipart/form-data">
@else
<form method="post" action="{{ route('operator.capaian-iku.store', $indikator->id) }}" enctype="multipart/form-data">
@endif
    {{ csrf_field() }}
    <div class="form-group row">
        <label class="col-sm-4">Tahun</label>
        <input type="number" name="tahun" class="form-control col-sm-8" placeholder="Tahun">
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Target</label>
        <input type="text" name="target" class="form-control col-sm-8" placeholder="12.3">
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Capaian</label>
        <input type="text" name="capaian" class="form-control col-sm-8" placeholder="23.4">
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Satuan</label>
        <input type="text" name="satuan" class="form-control col-sm-8" placeholder="%">
    </div>
    @include('partials.errors')
    <input type="submit" class="form-control btn btn-success" value="Tambah">
</form>