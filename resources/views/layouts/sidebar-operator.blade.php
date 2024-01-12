<ul class="nav">
  <li class="nav-item">
    <a class="nav-link" href="index.html">
      <i class="icon-grid menu-icon"></i>
      <span class="menu-title">Dashboard</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="collapse" href="#wilayah" aria-expanded="false" aria-controls="wilayah">
      <i class="icon-layout menu-icon"></i>
      <span class="menu-title">Master Data Kewilayahan</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="wilayah">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item"> <a class="nav-link" href="{{ url('operator/desa') }}">Desa</a></li>
        <li class="nav-item"> <a class="nav-link" href="{{ url('operator/kecamatan') }}">Kecamatan</a></li>
      </ul>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="collapse" href="#infrastruktur" aria-expanded="false" aria-controls="infrastruktur">
      <i class="icon-columns menu-icon"></i>
      <span class="menu-title">Master Data: Infrastruktur</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="infrastruktur">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item"><a class="nav-link" href="{{ url('operator/infrastruktur-jalan') }}">Jalan</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('operator/infrastruktur-jembatan') }}">Jembatan</a></li>
      </ul>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="collapse" href="#pariwisata" aria-expanded="false" aria-controls="pariwisata">
      <i class="icon-columns menu-icon"></i>
      <span class="menu-title">Master Data: Pariwisata</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="pariwisata">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item"><a class="nav-link" href="{{ url('operator/wisata') }}">Tempat Wisata</a></li>
      </ul>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="collapse" href="#pendidikan" aria-expanded="false" aria-controls="pendidikan">
      <i class="icon-columns menu-icon"></i>
      <span class="menu-title">Master Data: Pendidikan</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="pendidikan">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item"><a class="nav-link" href="{{ url('/operator/sekolah') }}">Sekolah</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/operator/guru') }}">Guru</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Jenis Sekolah</a></li>
      </ul>
    </div>
  </li><li class="nav-item">
    <a class="nav-link" data-toggle="collapse" href="#anggaran" aria-expanded="false" aria-controls="anggaran">
      <i class="icon-columns menu-icon"></i>
      <span class="menu-title">Master Data: Anggaran</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="anggaran">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">-</a></li>
      </ul>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="collapse" href="#pasar" aria-expanded="false" aria-controls="pasar">
      <i class="icon-columns menu-icon"></i>
      <span class="menu-title">Master Data: Pasar</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="pasar">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item"><a class="nav-link" href="{{ url('/operator/pasar') }}">Pasar</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/operator/komoditas-pasar') }}">Komoditas Pasar</a></li>
      </ul>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="collapse" href="#pertanian" aria-expanded="false" aria-controls="pertanian">
      <i class="icon-columns menu-icon"></i>
      <span class="menu-title">Master Data: Pertanian, Perikanan, dan Peternakan</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="pertanian">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Lahan</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/operator/kelompok-masyarakat-tani') }}">Kelompok Masyarakat</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Jenis Kelompok Masyarakat</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/operator/komoditas') }}">Komoditas</a></li>
      </ul>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="collapse" href="#kesehatan" aria-expanded="false" aria-controls="kesehatan">
      <i class="icon-columns menu-icon"></i>
      <span class="menu-title">Master Data: Kesehatan</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="kesehatan">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item"><a class="nav-link" href="{{ url('/operator/kesehatan-tenaga') }}">Tenaga Kesehatan</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/operator/kesehatan-fasyankes') }}">Fasyankes</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('operator/kesehatan-poli') }}">Poli</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Jenis Fasyankes</a></li>
      </ul>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="collapse" href="#credential" aria-expanded="false" aria-controls="credential">
      <i class="icon-columns menu-icon"></i>
      <span class="menu-title">Konfigurasi: Credential</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="credential">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item"><a class="nav-link" href="{{ url('/credential/user') }}">Credential</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/credential/route') }}">Route Management</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/credential/routing-group') }}">Route Group Management</a></li>
      </ul>
    </div>
  </li>
</ul>