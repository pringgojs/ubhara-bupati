@if(isset($nakes))
<form method="post" action="{{ url('operator/kesehatan-tenaga', $nakes->id) }}/edit" enctype="multipart/form-data">
@else
<form method="post" action="{{ url('operator/kesehatan-tenaga/create') }}" enctype="multipart/form-data">
@endif
    {{ csrf_field() }}
    <div class="form-group row">
        <label class="col-sm-4">Nama nakes</label>
        <input type="text" name="nama" class="form-control col-sm-8" placeholder="Nama nakes" @if(isset($nakes)) value="{{ $nakes->nama }}" @endif>
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Fasyankes</label>
        <select class="select2 form-control col-sm-8" name="fasyankes_id">
            @if(isset($nakes))
                @foreach($fasyankeses as $fasyankes)
                <option value="{{ $fasyankes->id }}" @if($nakes->fasyankes_id == $fasyankes->id) selected="selected" @endif>
                    {{ $fasyankes->nama }}
                </option>
                @endforeach
            @else
                @foreach($fasyankeses as $fasyankes)
                <option value="{{ $fasyankes->id }}">
                    {{ $fasyankes->nama }}
                </option>
                @endforeach
            @endif
        </select>
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Kepegawaian</label>
        <input type="text" name="kepegawaian" class="form-control col-sm-8" placeholder="Nama nakes" @if(isset($nakes)) value="{{ $nakes->kepegawaian }}" @endif>
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Jabatan</label>
        <input type="text" name="jabatan" class="form-control col-sm-8" placeholder="Nama nakes" @if(isset($nakes)) value="{{ $nakes->jabatan }}" @endif>
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Alamat</label>
        <input type="text" name="alamat" class="form-control col-sm-8" placeholder="Nama nakes" @if(isset($nakes)) value="{{ $nakes->alamat }}" @endif>
    </div>
    @include('partials.errors')
    <input type="submit" class="form-control btn btn-success" value="Submit">
</form>