@if(isset($pasar))
<form method="post" action="{{ url('operator/pasar', $pasar->id) }}/edit" enctype="multipart/form-data">
@else
<form method="post" action="{{ url('operator/pasar/create') }}" enctype="multipart/form-data">
@endif
    {{ csrf_field() }}
    <div class="form-group row">
        <label class="col-sm-4">Nama Pasar</label>
        <input type="text" name="nama" class="form-control col-sm-8" placeholder="Nama Desa" @if(isset($pasar)) value="{{ $pasar->nama }}" @endif>
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Deskripsi pasar</label>
        <input type="text" name="deskripsi" class="form-control col-sm-8" placeholder="Tuliskan deskripsi singkat mengenai jembatan ini" @if(isset($pasar)) value="{{ $pasar->deskripsi }}" @endif>
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Jenis Pasar</label>
        <select class="select2 form-control col-sm-8" name="jenis_pasar_id">
            @foreach($jenis_pasars as $jp)
                @if(isset($pasar))
                    <option value="{{ $jp->id }}" @if($pasar->jenis_pasar_id == $jp->id) selected="selected" @endif>{{ $jp->nama }}</option>
                @else
                <option value="{{ $jp->id }}">{{ $jp->nama }}</option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Alamat</label>
        <select class="select2 form-control col-sm-8" name="desa_id">
            @foreach($desas as $desa)
                <option value="{{ $desa->id }}" >Desa/Kel. {{ $desa->name }}, Kec. {{ $desa->kecamatan }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Tahun</label>
        <input type="number" name="tahun" class="form-control col-sm-8" placeholder="Nama Desa" @if(isset($pasar)) value="{{ $pasar->nama }}" @endif>
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Target Pemasukan</label>
        <input type="number" name="target_setoran" class="form-control col-sm-8" placeholder="Tuliskan deskripsi singkat mengenai jembatan ini" @if(isset($pasar)) value="{{ $pasar->deskripsi }}" @endif>
    </div>
    @include('partials.errors')
    <input type="submit" class="form-control btn btn-success" value="Submit">
</form>