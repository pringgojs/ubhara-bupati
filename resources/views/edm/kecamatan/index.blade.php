<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between">
          <p class="card-title">Executive Region Management Kecamatan {{ $kecamatan->name }} : {{ $modul }}</p>
          </div>
          <p class="font-weight-500">Menampilkan hasil analisis visual dari data masuk yang berkaitan tentang jalan di Kecamatan {{ $kecamatan->name }}</p>
        </div>
      </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <img src="{{ asset('img/peta-png.jpg') }}" style="width: 100%">
          <p class="card-title">Tentang Kecamatan {{ $kecamatan->name }}</p>
          <table>
            <tr><td>Luas Wilayah</td><td>:</td><td>345km<sup>2</sup></td></tr>
            <tr><td>Jumlah Desa/Kelurahan</td><td>:</td><td> {{ $kecamatan->desa->count() }}</td></tr>
            <tr><td>Nama Camat</td><td>:</td><td>Dr. Sulistyowati</td></tr>
            <tr><td>Alamat Camat</td><td>:</td><td>Jl. Arjuna no. 35 Ponorogo</td></tr>
            <tr><td>NIP Camat</td><td>:</td><td>19450817 200002 2 002</td></tr>
            <tr><td>Nomor Telefon Camat</td><td>:</td><td>08123456789</td></tr>
          </table>
        </div>
      </div>
  </div>
  <div class="col-md-8 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <p class="card-title">Pilih Informasi Menu</p>
          <p class="font-weight-500 card-caption">Pilih dashboard analisis kecamatan berdasarkan modul</p>
          <div class="row">
            <?php
            $moduls = ['infrastruktur-jalan','infrastruktur-jembatan','pariwisata','pendidikan','anggaran','pasar','pertanian','kesehatan'];
            $texts = ['Infrastruktur Jalan','Infrastruktur Jembatan','Modul Pariwisata','Modul Pendidikan','Modul Anggaran','Modul Pasar','Modul Pertanian','Modul Kesehatan'];
              ?>
              @for($i = 0; $i < count($moduls); $i++)
                <a href="{{ url('edm/kecamatan', $kecamatan->id) }}/{{ $moduls[$i] }}" class="region-link btn btn-{{ $moduls[$i]==$modul ? 'danger' : 'primary' }} col-sm-3">{{ $texts[$i] }}</a>
              @endfor
          </div>
          <p class="card-title">List Desa</p>
        <p class="font-weight-500 card-caption">List daftar desa yang ada di dalam kecamatan {{ $kecamatan->name }}</p>
        <table class="datatable" style="width: 100%">
          <thead>
              <td>No.</td>
              <td>Desa</td>
          </thead>
          <?php $counter = 1;?>
          @foreach($desas as $desa)
          <tr>
              <td>{{ $counter++ }}</td>
              <td><a href="{{ url('edm/desa', $desa->id) }}/{{ $modul }}" class="caption-with-link">{{$desa->name}}</a></td>
            </tr>
          @endforeach
      </table>
        </div>
      </div>
  </div>
</div>