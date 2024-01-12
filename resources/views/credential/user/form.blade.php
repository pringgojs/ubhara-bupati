@if(isset($credential))
<form method="post" action="{{ url('credential/user', $credential->id) }}/edit" enctype="multipart/form-data">
@else
<form method="post" action="{{ url('credential/user/create') }}" enctype="multipart/form-data">
@endif
    {{ csrf_field() }}
    <div class="form-group row">
        <label class="col-sm-4">Nama User</label>
        <input type="text" name="nama" class="form-control col-sm-8" placeholder="Nama User" @if(isset($credential)) value="{{ $credential->nama }}" @endif>
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Satker</label>
        <input type="text" name="satker" class="form-control col-sm-8" placeholder="Satuan Kerja" @if(isset($credential)) value="{{ $credential->satker }}" @endif>
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Username</label>
        <input type="text" name="username" class="form-control col-sm-8" placeholder="Username" @if(isset($credential)) value="{{ $credential->username }}" @endif>
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Password</label>
        <input type="text" name="password" class="form-control col-sm-8" placeholder="Password" @if(isset($credential)) value="{{ $credential->password }}" @endif>
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Access</label>
        <select class="select2 form-control col-sm-8" name="route_ids[]" multiple="multiple">
            @if(isset($selectedRoutes))
            @foreach($selectedRoutes as $route)
            <option value="{{ $route->id }}" selected="selected">{{ $route->name }} (Menu: {{ $route->menu }})</option>
            @endforeach
            @endif
            @foreach($routes as $route)
            <option value="{{ $route->id }}">{{ $route->name }} (Menu: {{ $route->menu }})</option>
            @endforeach
        </select>
    </div>
    <input type="submit" class="form-control btn btn-success" value="Submit">
</form>