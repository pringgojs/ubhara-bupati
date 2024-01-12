@if(isset($komoditas))
<form method="post" action="{{ url('operator/komoditas-pasar', $komoditas->id) }}/edit" enctype="multipart/form-data">
@else
<form method="post" action="{{ url('operator/komoditas-pasar/create') }}" enctype="multipart/form-data">
@endif
    {{ csrf_field() }}
    <div class="form-group row">
        <label class="col-sm-4">Nama Komoditas</label>
        <input type="text" name="nama" class="form-control col-sm-8" placeholder="Nama Kelompok" @if(isset($komoditas)) value="{{ $komoditas->nama }}" @endif>
    </div>
    @include('partials.errors')
    <input type="submit" class="form-control btn btn-success" value="Submit">
</form>