@if(isset($pengunjung))
<form method="post" action="{{ url('operator/pengunjung-wisata', $pengunjung->id) }}/edit" enctype="multipart/form-data">
@else
<form method="post" action="{{ url('operator/pengunjung-wisata/create') }}" enctype="multipart/form-data">
@endif
    {{ csrf_field() }}
    <div class="form-group row">
        <label class="col-sm-4">Wisata</label>
        <select class="select2 form-control col-sm-8" name="tempat_wisata_id">
            @if(isset($pengunjung))
                <option value="{{ $pengunjung->wisata->id }}" selected="selected">{{ $pengunjung->wisata->nama }}</option>
            @endif
            @foreach($wisatas as $item)
                <option value="{{ $item->id }}">{{ $item->nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Pengunjung</label>
        <input type="number" name="pengunjung" class="form-control col-sm-8" placeholder="0" @if(isset($pengunjung)) value="{{ $pengunjung->pengunjung }}" @endif>
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Harga</label>
        <input type="number" name="harga" class="form-control col-sm-8" placeholder="0" @if(isset($pengunjung)) value="{{ $pengunjung->harga }}" @endif>
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Keterangan</label>
        <input type="text" name="keterangan" class="form-control col-sm-8" placeholder="keterangan" @if(isset($pengunjung)) value="{{ $pengunjung->keterangan }}" @endif>
    </div>
    <div class="form-grup row">
        <label class="col-sm-4">Tanggal Kunjungan</label>
        <input type="date" class="form-control col-sm-8" name="tanggal_data" @if(isset($pengunjung)) value="{{ $pengunjung->tanggal_data }}" @endif>
    </div>
    @include('partials.errors')
    <input type="submit" class="form-control btn btn-success" value="Submit">
</form>