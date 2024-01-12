@if(isset($target))
<form method="post" action="{{ url('operator/pasar', $target->id) }}/edit" enctype="multipart/form-data">
@else
<form method="post" action="{{ route('operator.setoran-pasar.create-setoran', $pasar->id) }}" enctype="multipart/form-data">
@endif
    {{ csrf_field() }}
    <div class="form-group row">
        <label class="col-sm-4">Tahun Anggaran</label>
        <select class="select2 form-control col-sm-8" name="tahun">
            @foreach($targets as $target)
                <option value="{{ $target->id }}" >{{ $target->tahun_anggaran }} (Rp. {{ number_format($target->target, 2, ',','.') }})</option>
            @endforeach
        </select>
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Setoran</label>
        <input type="number" name="setoran" class="form-control col-sm-8" placeholder="Nama Desa" @if(isset($target)) value="{{ $target->tahun }}" @endif>
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Tanggal Setoran</label>
        <input type="date" name="tanggal_data" class="form-control col-sm-8" placeholder="Nama Desa" @if(isset($target)) value="{{ $target->tahun }}" @endif>
    </div>
    @include('partials.errors')
    <input type="submit" class="form-control btn btn-success" value="Submit">
</form>