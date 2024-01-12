@if(isset($anggota))
<form method="post" action="{{ url('operator/kelompok-masyarakat-tani/'.$kmt->id.'/'.$anggota->id) }}/edit" enctype="multipart/form-data">
@else
<form method="post" action="{{ url('operator/kelompok-masyarakat-tani/'.$kmt->id.'/create') }}" enctype="multipart/form-data">
@endif
    {{ csrf_field() }}
    <div class="form-group row">
        <label class="col-sm-4">Nama</label>
        <input type="text" name="nama" class="form-control col-sm-8" placeholder="Nama Kelompok" @if(isset($anggota)) value="{{ $anggota->nama }}" @endif>
    </div>
    <div class="form-group row">
        <label class="col-sm-4">NIK</label>
        <input type="text" name="nik" class="form-control col-sm-8" placeholder="NIK" @if(isset($anggota)) value="{{ $anggota->nik }}" @endif>
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Jenis Kelamin</label>
        <select class="select2 form-control col-sm-8" name="jenis_kelamin">
            @if(isset($anggota))
            <option value="laki-laki" @if($anggota->jenis_kelamin == 'laki-laki') selected="selected" @endif>Laki-laki</option>
            <option value="perempuan" @if($anggota->jenis_kelamin == 'perempuan') selected="selected" @endif>Perempuan</option>
            @else
            <option value="laki-laki" >Laki-laki</option>
            <option value="perempuan" >Perempuan</option>
            @endif
        </select>
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Alamat</label>
        <input type="text" name="alamat" class="form-control col-sm-8" placeholder="Alamat" @if(isset($anggota)) value="{{ $anggota->alamat }}" @endif>
    </div>
    @include('partials.errors')
    <input type="submit" class="form-control btn btn-success" value="Submit">
</form>