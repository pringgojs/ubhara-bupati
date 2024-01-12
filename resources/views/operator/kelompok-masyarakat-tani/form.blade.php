@if(isset($kmt))
<form method="post" action="{{ url('operator/kelompok-masyarakat-tani', $kmt->id) }}/edit" enctype="multipart/form-data">
@else
<form method="post" action="{{ url('operator/kelompok-masyarakat-tani/create') }}" enctype="multipart/form-data">
@endif
    {{ csrf_field() }}
    <div class="form-group row">
        <label class="col-sm-4">Nama Kelompok</label>
        <input type="text" name="nama" class="form-control col-sm-8" placeholder="Nama Kelompok" @if(isset($kmt)) value="{{ $kmt->nama }}" @endif>
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Nama Ketua</label>
        <input type="text" name="ketua" class="form-control col-sm-8" placeholder="Nama Ketua Kelompok" @if(isset($kmt)) value="{{ $kmt->ketua }}" @endif>
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Desa/Kelurahan</label>
        <select class="select2 form-control col-sm-8" name="desa_id">
            @if(isset($kmt))
            @foreach($desas as $desa)
                <option value="{{ $desa->id }}" @if($desa->id == $kmt->desa_id) selected="selected" @endif>Desa/Kel. {{ $desa->name }}, Kec. {{ $desa->kecamatan }}</option>
            @endforeach
            @else
            @foreach($desas as $desa)
                <option value="{{ $desa->id }}">Desa/Kel. {{ $desa->name }}, Kec. {{ $desa->kecamatan }}</option>
            @endforeach
            @endif
        </select>
    </div>
    @include('partials.errors')
    <input type="submit" class="form-control btn btn-success" value="Submit">
</form>