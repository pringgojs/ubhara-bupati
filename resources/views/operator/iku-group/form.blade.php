@if(isset($group))
<form method="post" action="{{ route('operator.iku-group.update', $group->id) }}" enctype="multipart/form-data">
@else
<form method="post" action="{{ route('operator.iku-group.store') }}" enctype="multipart/form-data">
@endif
    {{ csrf_field() }}
    <div class="form-group row">
        <label class="col-sm-4">Nama</label>
        <input type="text" name="nama" class="form-control col-sm-8" placeholder="Aspek Indikator">
    </div>
    @include('partials.errors')
    <input type="submit" class="form-control btn btn-success" value="Tambah">
</form>