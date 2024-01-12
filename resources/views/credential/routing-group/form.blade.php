@if(isset($group))
<form method="post" action="{{ url('credential/routing-group', $group->id) }}/edit" enctype="multipart/form-data">
@else
<form method="post" action="{{ url('credential/routing-group/create') }}" enctype="multipart/form-data">
@endif
    {{ csrf_field() }}
    <div class="form-group row">
        <label class="col-sm-4">Nama Route Group</label>
        <input type="text" name="name" class="form-control col-sm-8" placeholder="Nama User" @if(isset($group)) value="{{ $group->name }}" @endif>
    </div>
    <input type="submit" class="form-control btn btn-success" value="Submit">
</form>