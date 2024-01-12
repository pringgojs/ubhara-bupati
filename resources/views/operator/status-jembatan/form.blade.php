@if(isset($status))
<form method="post" action="{{ url('operator/status-jembatan', $status->id) }}/edit" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group row">
        <label class="col-sm-4">Status</label>
        <input type="text" name="status" class="form-control col-sm-8" placeholder="status" @if(isset($status)) value="{{ $status->status }}" @endif>
    </div>
    <input type="submit" class="form-control btn btn-success" value="Submit">
</form>
@endif
   