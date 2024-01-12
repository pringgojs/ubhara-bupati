@if(isset($fasyankesChange))
<form method="post" action="{{ url('operator/kesehatan-fasyankes', $fasyankesChange->id) }}/delete" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group row">
        <label class="col-sm-4">Alihkan Fasyankes</label>
        <select class="select2 form-control col-sm-8" name="fasyankes_id">
            @if(isset($fasyankes))
                @foreach($fasyankes as $data)
                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                @endforeach
            @endif
        </select>
    </div>
    <input type="submit" class="form-control btn btn-success" value="Submit">
</form>
@endif