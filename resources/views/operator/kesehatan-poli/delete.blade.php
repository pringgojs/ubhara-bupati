@if(isset($polisChange))
<form method="post" action="{{ url('operator/kesehatan-poli', $polisChange->id) }}/delete" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group row">
        <label class="col-sm-4">Alihkan Poli</label>
        <select class="select2 form-control col-sm-8" name="poli_id">
            @if(isset($polis))
                @foreach($polis as $data)
                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                @endforeach
            @endif
        </select>
    </div>
    <input type="submit" class="form-control btn btn-success" value="Submit">
</form>
@endif