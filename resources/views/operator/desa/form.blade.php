<form method="post" action="{{ url('operator/desa', $desa->id) }}/edit" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group row">
        <label class="col-sm-4">Nama Desa</label>
        <input type="text" name="name" class="form-control col-sm-8" placeholder="Nama Desa" value="{{ $desa->name}}">
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Kecamatan</label>
        <select class="select2 form-control col-sm-8" name="kecamatan_id">
            @foreach($kecamatans as $kecamatan)
                @if($kecamatan->id == $desa->kecamatan_id)
                    <option value="{{ $kecamatan->id }}" selected="selected">Kecamatan {{ $kecamatan->name }}</option>
                @else
                    <option value="{{ $kecamatan->id }}">Kecamatan {{ $kecamatan->name }}</option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Luas Desa</label>
        <input type="number" name="luas" class="form-control col-sm-8" placeholder="km persegi" value="{{ $desa->luas}}">
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Nama Kepala Desa/Lurah</label>
        <input type="text" name="lurah" class="form-control col-sm-8" placeholder="Nama Camat" value="{{ $desa->lurah}}">
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Alamat Kepala Desa/Lurah</label>
        <input type="text" name="alamat_lurah" class="form-control col-sm-8" placeholder="Alamat Kepala Desa/Lurah" value="{{ $desa->alamat_lurah}}">
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Telp Kepala Desa/Lurah</label>
        <input type="text" name="telp_lurah" class="form-control col-sm-8" placeholder="08123456789" value="{{ $desa->telp_lurah}}">
    </div>
    <!--div class="form-group row">
        <img src="{{ Storage::url($desa->foto) }}" style="width: 100%">
        <label class="col-sm-4">Foto Wilayah</label>
        <input type="file" name="foto" class="form-control col-sm-8" placeholder="Foto Wilayah" value="">
    </div-->
    @include('partials.errors')
    <input type="submit" class="form-control btn btn-success" value="Ubah">
</form>