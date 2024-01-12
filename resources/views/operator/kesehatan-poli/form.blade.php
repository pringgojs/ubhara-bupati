@if(isset($poli))
<form method="post" action="{{ url('operator/kesehatan-poli', $poli->id) }}/edit" enctype="multipart/form-data">
@else
<form method="post" action="{{ url('operator/kesehatan-poli/create') }}" enctype="multipart/form-data">
@endif
    {{ csrf_field() }}
    <div class="form-group row">
        <label class="col-sm-4">Nama Tempat poli</label>
        <input type="text" name="nama" class="form-control col-sm-8" placeholder="Nama Poli" @if(isset($poli)) value="{{ $poli->nama }}" @endif>
    </div>
    @include('partials.errors')
    <input type="submit" class="form-control btn btn-success" value="Submit">
</form>