@if(isset($kunjungan))
<form method="post" action="{{ url('operator/kunjungan-poli', $kunjungan->id) }}/edit" enctype="multipart/form-data">
@else
<form method="post" action="{{ url('operator/kunjungan-poli/create') }}" enctype="multipart/form-data">
@endif
    {{ csrf_field() }}
    <div class="form-group row">
        <label class="col-sm-4">Poli</label>
        <select class="select2 form-control col-sm-8" name="kesehatan_poli_id">
            @if(isset($kunjungan))
                <option value="{{ $kunjungan->poli->id }}" selected="selected">{{ $kunjungan->poli->nama }}</option>
            @endif
            @foreach($polis as $poli)
                <option value="{{ $poli->id }}">{{ $poli->nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Total Kunjungan</label>
        <input type="text" name="total_kunjungan" class="form-control col-sm-8" placeholder="0" @if(isset($kunjungan)) value="{{ $kunjungan->total_kunjungan }}" @endif>
    </div>
    <div class="form-grup row">
        <label class="col-sm-4">Tanggal Kunjungan</label>
        <input type="date" class="form-control col-sm-8" name="tanggal_kunjungan" @if(isset($kunjungan)) value="{{ $kunjungan->tanggal_kunjungan }}" @endif>
    </div>
    @include('partials.errors')
    <input type="submit" class="form-control btn btn-success" value="Submit">
</form>