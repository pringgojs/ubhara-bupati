<form method="post" action="{{ url('operator/kecamatan', $kecamatan->id) }}/edit" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group row">
        <label class="col-sm-4">Nama Kecamatan</label>
        <input type="text" name="name" class="form-control col-sm-8" placeholder="Nama Kecamatan" value="{{ $kecamatan->name }}">
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Luas Kecamatan</label>
        <input type="number" name="luas" class="form-control col-sm-8" placeholder="km persegi" value="{{ $kecamatan->luas }}">
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Nama Camat</label>
        <input type="text" name="camat" class="form-control col-sm-8" placeholder="Nama Camat" value="{{ $kecamatan->camat }}">
    </div>
    <div class="form-group row">
        <label class="col-sm-4">NIP Camat</label>
        <input type="text" name="nip" class="form-control col-sm-8" placeholder="19450817 200008 1 001" value="{{ $kecamatan->nip }}">
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Alamat Camat</label>
        <input type="text" name="alamat_camat" class="form-control col-sm-8" placeholder="Alamat Camat" value="{{ $kecamatan->alamat_camat }}">
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Telp Camat</label>
        <input type="text" name="telp_camat" class="form-control col-sm-8" placeholder="08123456789" value="{{ $kecamatan->telp_camat }}">
    </div>
    <!--div class="form-group row">
        <img src="{{ Storage::url($kecamatan->foto) }}" style="width: 100%">
        <label class="col-sm-4">Foto Wilayah</label>
        <input type="file" name="foto" class="form-control col-sm-8" placeholder="Foto Wilayah" value="{{ $kecamatan->foto }}">
    </div-->
    @include('partials.errors')
    <input type="submit" class="form-control btn btn-success" value="Ubah">
</form>