<ul class="nav">
  <li class="nav-item">
    <a class="nav-link" href="{{ url('dashboard') }}">
      <i class="icon-grid menu-icon"></i>
      <span class="menu-title">Dashboard</span>
    </a>
  </li>
  @foreach(session()->get('menu_groups') as $menu_group)
  <li class="nav-item">
    <a class="nav-link" data-toggle="collapse" href="#menu_{{$menu_group->id}}" aria-expanded="false" aria-controls="menu_{{$menu_group->id}}">
      <i class="icon-layout menu-icon"></i>
      <span class="menu-title">{{ $menu_group->name }}</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="menu_{{$menu_group->id}}">
      <ul class="nav flex-column sub-menu">
        @foreach($menu_group->menus as $menu)
            <li class="nav-item"> <a class="nav-link" href="{{ route($menu->index) }}">{{ $menu->name }}</a></li>
        @endforeach
      </ul>
    </div>
  </li>
  @endforeach
</ul>