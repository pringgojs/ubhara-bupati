@if(isset($wisataSelected))
<form method="post" action="{{ url('operator/wisata', $wisataSelected->id) }}/edit" enctype="multipart/form-data">
@else
<form method="post" action="{{ url('operator/wisata/create') }}" enctype="multipart/form-data">
@endif
    {{ csrf_field() }}
    <div class="form-group row">
        <label class="col-sm-4">Nama Tempat Wisata</label>
        <input type="text" name="nama" class="form-control col-sm-8" placeholder="Nama Tempat" @if(isset($wisataSelected)) value="{{ $wisataSelected->nama }}" @endif>
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Deskripsi Tempat Wisata</label>
        <input type="text" name="deskripsi" class="form-control col-sm-8" placeholder="Tuliskan deskripsi singkat mengenai jembatan ini" @if(isset($wisataSelected)) value="{{ $wisataSelected->deskripsi }}" @endif>
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Desa/Kelurahan</label>
        <select class="select2 form-control col-sm-8" name="desa_ids[]" multiple="multiple">
            @if(isset($connectedWisata))
                @foreach($connectedWisata as $desa)
                    <option value="{{ $desa->id }}"  selected="selected">Desa/Kel. {{ $desa->name }}, Kec. {{ $desa->kecamatan }}</option>
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