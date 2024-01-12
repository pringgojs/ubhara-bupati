@if(isset($fasyankes))
<form method="post" action="{{ url('operator/kesehatan-fasyankes', $fasyankes->id) }}/edit" enctype="multipart/form-data">
@else
<form method="post" action="{{ url('operator/kesehatan-fasyankes/create') }}" enctype="multipart/form-data">
@endif
    {{ csrf_field() }}
    <div class="form-group row">
        <label class="col-sm-4">Nama Tempat fasyankes</label>
        <input type="text" name="nama" class="form-control col-sm-8" placeholder="Nama fasyankes" @if(isset($fasyankes)) value="{{ $fasyankes->nama }}" @endif>
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Jenis Fasyankes</label>
        <select class="select2 form-control col-sm-8" name="jenis_fasyankes_id">
            @if(isset($fasyankes))
                @foreach($jenises as $data)
                    <option value="{{ $data->id }}" @if ($data->id == $fasyankes->jenis_fasyankes_id) selected="selected" @endif>{{ $data->nama }}</option>
                @endforeach
            @else
                @foreach($jenises as $data)
                    <option value="{{ $data->id }}" >{{ $data->nama }}</option>
                @endforeach
            @endif
        </select>
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Desa/Kelurahan</label>
        <select class="select2 form-control col-sm-8" name="desa_id">
            @if(isset($fasyankes))
                @foreach($desas as $desa)
                    <option value="{{ $desa->id }}" @if ($desa->id == $fasyankes->desa_id) selected="selected" @endif>Desa/Kel. {{ $desa->name }}, Kec. {{ $desa->kecamatan }}</option>
                @endforeach
            @else
            @foreach($desas as $desa)
                <option value="{{ $desa->id }}" >Desa/Kel. {{ $desa->name }}, Kec. {{ $desa->kecamatan }}</option>
            @endforeach
            @endif
        </select>
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Poli</label>
        <select class="select2 form-control col-sm-8" name="kesehatan_poli_ids[]" multiple="multiple">
            @if(isset($fasyankes))
                @foreach($selectedPolis as $poli)
                    <option value="{{ $poli->id }}" selected="selected">{{ $poli->nama }}</option>
                @endforeach
            @endif
            @foreach($polis as $poli)
                <option value="{{ $poli->id }}">{{ $poli->nama }}</option>
            @endforeach
        </select>
    </div>
    @include('partials.errors')
    <input type="submit" class="form-control btn btn-success" value="Submit">
</form>