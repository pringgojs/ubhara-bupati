<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tables = [
            'kecamatans', 'desas', 'infrastruktur_jalans', 'infrastruktur_jembatans', 'status_jalans', 'status_jembatans', 'lampiran_status_jalans', 'lampiran_status_jembatans',
            'desa_to_jalans', 'desa_to_jembatans', 'tempat_wisatas', 'pengunjung_wisatas', 'foto_wisatas', 'desa_to_wisatas', 'jenis_sekolahs', 'sekolahs', 'guru_sekolahs', 'murid_sekolahs', 'foto_sekolahs', 'prestasi_sekolahs',
            'desa_to_sekolahs', 'jenis_lahans', 'kelompok_masyarakat_tanis', 'anggota_kelompok_masyarakat_tanis', 'lahan_pertanians', 'komoditas_lahans', 'panen_lahans', 'kesehatan_polis', 'jenis_fasyankes', 'fasyankes', 'poli_to_fasyankes', 
            'jenis_pasars', 'pasars', 'penjuals', 'komoditas_pasars', 'komoditas_pasar_to_penjuals', 'tenaga_kesehatans', 'kecamatan_to_jalans', 'kecamatan_to_jembatans', 'users',
        ];
        foreach($tables as $item){
            Schema::connection(env('DB_CONNECTION'))->table($item, function (Blueprint $table) {
                $table->softDeletes();
            });
        }

        $tables2 = [
            'routing_groups', 'menus', 'routes', 'credentials', 'credential_to_routes'
        ];
        foreach($tables2 as $item){
            Schema::connection(env('CRED_DB_CONNECTION'))->table($item, function (Blueprint $table) {
                $table->softDeletes();
            });
        }

        $tables3 = [
            'file_jalans', 'file_jembatans', 'file_jalan_contents', 'file_jembatan_contents', 'file_nakes', 'file_nakes_contents'
        ];
        foreach($tables3 as $item){
            Schema::connection(env('FILE_DB_CONNECTION'))->table($item, function (Blueprint $table) {
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
};
