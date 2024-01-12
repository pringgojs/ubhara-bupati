<form method="post" action="{{ url('operator/infrastruktur-jembatan', $jembatan->id) }}/edit" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group row">
        <label class="col-sm-4">Nama jembatan</label>
        <input type="text" name="nama" class="form-control col-sm-8" placeholder="Nama Desa" value="{{ $jembatan->nama }}">
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Deskripsi jembatan</label>
        <input type="text" name="deskripsi" class="form-control col-sm-8" placeholder="Tuliskan deskripsi singkat mengenai jembatan ini" value="{{ $jembatan->deskripsi }}">
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Nomor</label>
        <input type="number" name="nomor" class="form-control col-sm-8" placeholder="" value="{{ $jembatan->nomor }}">
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Kecamatan</label>
        <select class="select2 form-control col-sm-8" name="kecamatan_ids[]" multiple="multiple">
            @foreach($connectedJembatan as $item)
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