@if(isset($iku))
<form method="post" action="{{ route('operator.iku.update', $iku->id) }}" enctype="multipart/form-data">
@else
<form method="post" action="{{ route('operator.iku.store') }}" enctype="multipart/form-data">
@endif
    {{ csrf_field() }}
    <div class="form-group row">
        <label class="col-sm-4">Aspek Indikator</label>
        <input type="text" name="aspek" class="form-control col-sm-8" placeholder="Aspek Indikator">
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Keterangan RPJMD</label>
        <select class="select2 form-control col-sm-8" name="indikator_id" required="required">
            @foreach($indikators as $indikator)
                <option value="{{ $indikator->id }}">{{ $indikator->nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group row">
        <label class="col-sm-4">SKPD Penanggungjawab</label>
        <input type="text" name="skpd" class="form-control col-sm-8" placeholder="SKPD Penanggunjawab">
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Sumber</label>
        <input type="text" name="sumber" class="form-control col-sm-8" placeholder="Sumber">
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Keterangan</label>
        <input type="text" name="keterangan" class="form-control col-sm-8" placeholder="Keterangan">
    </div>
    @include('partials.errors')
    <input type="submit" class="form-control btn btn-success" value="Tambah">
</form>