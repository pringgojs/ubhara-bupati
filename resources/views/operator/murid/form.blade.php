@if(isset($murid))
<form method="post" action="{{ url('operator/murid', $murid->id) }}/edit" enctype="multipart/form-data">
@else
<form method="post" action="{{ url('operator/murid/create') }}" enctype="multipart/form-data">
@endif
    {{ csrf_field() }}
    <div class="form-group row">
        <label class="col-sm-4">Kelas</label>
        <input type="text" name="kelas" class="form-control col-sm-8" placeholder="Kelas" @if(isset($murid)) value="{{ $murid->kelas }}" @endif>
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Asal Sekolah</label>
        <select class="select2 form-control col-sm-8" name="sekolah_id">
            @if(isset($murid))
                @foreach($sekolahs as $sekolah)
                <option value="{{ $sekolah->id }}" @if($murid->sekolah_id == $sekolah->id) selected="selected" @endif>
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
        <label class="col-sm-4">Jumlah</label>
        <input type="number" name="jumlah" class="form-control col-sm-8" placeholder="" @if(isset($murid)) value="{{ $murid->jumlah }}" @endif>
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Tahun Ajaran</label>
        <input type="number" name="tahun_ajaran" class="form-control col-sm-8" placeholder="" @if(isset($murid)) value="{{ $murid->tahun_ajaran }}" @endif>
    </div>
    @include('partials.errors')
    <input type="submit" class="form-control btn btn-success" value="Submit">
</form>