<ul class="nav">
  <li class="nav-item">
    <a class="nav-link" href="index.html">
      <i class="icon-grid menu-icon"></i>
      <span class="menu-title">Dashboard</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
      <i class="icon-layout menu-icon"></i>
      <span class="menu-title">Infrastruktur</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="ui-basic">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item"> <a class="nav-link" href="{{ url('edm/infrastruktur-jalan') }}">Dashboard Jalan</a></li>
        <li class="nav-item"> <a class="nav-link" href="{{ url('edm/infrastruktur-jembatan') }}">Dashboard Jembatan</a></li>
      </ul>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
      <i class="icon-columns menu-icon"></i>
      <span class="menu-title">Pariwisata</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="form-elements">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item"><a class="nav-link" href="{{ url('edm/wisata') }}">Dashboard Wisata</a></li>
      </ul>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
      <i class="icon-bar-graph menu-icon"></i>
      <span class="menu-title">Pendidikan</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="charts">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item"> <a class="nav-link" href="{{ url('edm/pendidikan') }}">Dashboard Summary</a></li>
      </ul>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
      <i class="icon-grid-2 menu-icon"></i>
      <span class="menu-title">Anggaran</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="tables">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item"> <a class="nav-link" href="{{ url('edm/anggaran') }}">Dashboard Summary</a></li>
        <li class="nav-item"> <a class="nav-link" href="#">Analisis Instansi</a></li>
        <li class="nav-item"> <a class="nav-link" href="#">Analisis Realisasi</a></li>
      </ul>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
      <i class="icon-contract menu-icon"></i>
      <span class="menu-title">Pasar dan Pusat Perbelanjaan</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="icons">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item"> <a class="nav-link" href="{{ url('edm/pasar') }}">Dashboard Summary</a></li>
      </ul>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
      <i class="icon-head menu-icon"></i>
      <span class="menu-title">Pertanian, Perikanan, dan Peternakan</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="auth">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item"> <a class="nav-link" href="{{ url('edm/pertanian') }}">Dashboard Summary</a></li>
      </ul>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ url('edm/kesehatan') }}">
      <i class="icon-paper menu-icon"></i>
      <span class="menu-title">Kesehatan</span>
    </a>
  </li>
</ul>