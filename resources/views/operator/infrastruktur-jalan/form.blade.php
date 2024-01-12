<form method="post" action="{{ url('operator/infrastruktur-jalan', $jalan->id) }}/edit" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group row">
        <label class="col-sm-4">Nama Jalan</label>
        <input type="text" name="nama" class="form-control col-sm-8" placeholder="Nama Jalan" value="{{ $jalan->nama }}">
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Deskripsi Jalan</label>
        <input type="text" name="deskripsi" class="form-control col-sm-8" placeholder="Tuliskan deskripsi singkat mengenai jalan ini" value="{{ $jalan->deskripsi }}">
    </div>
    <div class="form-group row">
        <label class="col-sm-4">No Ruas</label>
        <input type="number" name="no_ruas" class="form-control col-sm-8" placeholder="" value="{{ $jalan->no_ruas }}">
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Kecamatan</label>
        <select class="select2 form-control col-sm-8" name="kecamatan_ids[]" multiple="multiple">
            @foreach($connectedJalan as $item)
            <option value="{{ $item->id }}" selected="selected">Kecamatan {{ $item->name }}</option>
            @endforeach
            @foreach($kecamatans as $item)
            <option value="{{ $item->id }}">Kecamatan {{ $item->name }}</option>
            @endforeach
        </select>
    </div>
    @include('partials.errors')
    <input type="submit" class="form-control btn btn-success" value="Ubah">
</form>