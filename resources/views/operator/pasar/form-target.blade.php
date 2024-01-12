@if(isset($target))
<form method="post" action="{{ url('operator/pasar', $target->id) }}/edit" enctype="multipart/form-data">
@else
<form method="post" action="{{ route('operator.setoran-pasar.create-target', $pasar->id) }}" enctype="multipart/form-data">
@endif
    {{ csrf_field() }}
    <div class="form-group row">
        <label class="col-sm-4">Tahun Anggaran</label>
        <input type="number" name="tahun" class="form-control col-sm-8" placeholder="Nama Desa" @if(isset($target)) value="{{ $target->tahun }}" @endif>
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Target</label>
        <input type="number" name="target" class="form-control col-sm-8" placeholder="Tuliskan deskripsi singkat mengenai jembatan ini" @if(isset($target)) value="{{ $target->target }}" @endif>
    </div>
    @include('partials.errors')
    <input type="submit" class="form-control btn btn-success" value="Submit">
</form>