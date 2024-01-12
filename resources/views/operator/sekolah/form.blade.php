@if(isset($sekolah))
<form method="post" action="{{ url('operator/sekolah', $sekolah->id) }}/edit" enctype="multipart/form-data">
@else
<form method="post" action="{{ url('operator/sekolah/create') }}" enctype="multipart/form-data">
@endif
    {{ csrf_field() }}
    <div class="form-group row">
        <label class="col-sm-4">Nama Tempat sekolah</label>
        <input type="text" name="nama" class="form-control col-sm-8" placeholder="Nama Sekolah" @if(isset($sekolah)) value="{{ $sekolah->nama }}" @endif>
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Jenis Sekolah</label>
        <select class="select2 form-control col-sm-8" name="jenis_sekolah_id">
            @if(isset($sekolah))
                @foreach($jenisSekolahs as $js)
                    <option value="{{ $js->id }}" @if($js->id == $sekolah->jenis_sekolah_id) selected="selected" @endif>
                        {{ $js->nama }} @if($js->negeri) Negeri @else Swasta @endif
                    </option>
                @endforeach
            @else
                @foreach($jenisSekolahs as $js)
                <option value="{{ $js->id }}">
                    {{ $js->nama }} @if($js->negeri) Negeri @else Swasta @endif
                </option>
                @endforeach
            @endif
        </select>
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Desa/Kelurahan</label>
        <select class="select2 form-control col-sm-8" name="desa_ids[]">
            @if(isset($connectedSekolah))
                @foreach($connectedSekolah as $desa)
                    <option value="{{ $desa->id }}" selected="selected">Desa/Kel. {{ $desa->name }}, Kec. {{ $desa->kecamatan }}</option>
                @endforeach
            @endif
            @foreach($desas as $desa)
                <option value="{{ $desa->id }}" >Desa/Kel. {{ $desa->name }}, Kec. {{ $desa->kecamatan }}</option>
            @endforeach
        </select>
    </div>
    @include('partials.errors')
    <input type="submit" class="form-control btn btn-success" value="Submit">
</form>