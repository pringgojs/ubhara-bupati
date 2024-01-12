@if(isset($route))
<form method="post" action="{{ url('credential/route', $route->id) }}/edit" enctype="multipart/form-data">
@else
<form method="post" action="{{ url('credential/route/create') }}" enctype="multipart/form-data">
@endif
    {{ csrf_field() }}
    <div class="form-group row">
        <label class="col-sm-4">Route Naming</label>
        <input type="text" name="name" class="form-control col-sm-8" placeholder="Route Naming" @if(isset($route)) value="{{ $route->name }}" @endif>
    </div>
    <div class="form-group row">
        <label class="col-sm-4">Menu</label>
        <select class="select2 form-control col-sm-8" name="menu_id">
            @if(isset($route))
                @if($route->menu_id == null)
                    <option value="0" selected="selected">Tanpa Menu</option>
                @else
                    <option value="0">Tanpa Menu</option>
                @endif
                    @foreach($menus as $menu)
                        <option value="{{ $menu->id }}" @if($menu->id == $route->menu_id) selected="selected" @endif>{{ $menu->routing_group }} - {{ $menu->name }}</option>
                    @endforeach
            @else
                <option value="0">Tanpa Menu</option>
                @foreach($menus as $menu)
                    <option value="{{ $menu->id }}" > {{ $menu->routing_group }} - {{ $menu->name }}</option>
                @endforeach
            @endif
        </select>
    </div>
    <input type="submit" class="form-control btn btn-success" value="Submit">
</form>