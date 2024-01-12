@if(isset($guru))
<form method="post" action="{{ url('operator/guru', $guru->id) }}/edit" enctype="multipart/form-data">
@else
<form method="post" action="{{ url('operator/guru/create') }}" enctype="multipart/form-data">
@endif
    {{ csrf_field() }}
    <div class="form-group row">
        <label class="col-sm-4">Nama Guru</label>
        <input type="text" name="nama" class="form-control col-sm-8" placeholder="Nama guru" @if(isset($guru)) value="{{ $guru->nama }}" @endif>
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Asal Sekolah</label>
        <select class="select2 form-control col-sm-8" name="sekolah_id">
            @if(isset($guru))
                @foreach($sekolahs as $sekolah)
                <option value="{{ $sekolah->id }}" @if($guru->sekolah_id == $sekolah->id) selected="selected" @endif>
                    {{ $sekolah->nama }}
                </option>
                @endforeach
            @else
                @foreach($sekolahs as $sekolah)
                <option value="{{ $sekolah->id }}">
                    {{ $sekolah->nama }}
                </option>
                @endforeach
            @endif
        </select>
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Mata Pelajaran</label>
        <input type="text" name="mapel" class="form-control col-sm-8" placeholder="Nama guru" @if(isset($guru)) value="{{ $guru->mapel }}" @endif>
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" class="form-control col-sm-8" placeholder="Nama guru" @if(isset($guru)) value="{{ $guru->tanggal_lahir }}" @endif>
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Alamat</label>
        <input type="text" name="alamat" class="form-control col-sm-8" placeholder="Nama guru" @if(isset($guru)) value="{{ $guru->alamat }}" @endif>
    </div>
    @include('partials.errors')
    <input type="submit" class="form-control btn btn-success" value="Submit">
</form>