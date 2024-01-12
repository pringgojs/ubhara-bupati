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
        Schema::connection('file_db')->create('file_jembatan_contents', function (Blueprint $table) {
            $table->id();
            $table->string('ruasjalan_no');
            $table->string('jembatan_nolama');
            $table->string('jembatan_nobaru');
            $table->string('ruasjalan_panjang');
            $table->string('ruasjalan_nama');
            $table->string('jembatan_nourut');
            $table->string('jembatan_nama');
            $table->string('jalan_kecamatan');
            $table->string('jembatan_kecamatan');
            $table->string('koordinat_x');
            $table->string('koordinat_y');
            $table->string('pal_km');
            $table->string('tipe_struktur');
            $table->string('tipe_penyeberangan');
            $table->string('jembatan_panjang');
            $table->string('jembatan_lebarjalur');
            $table->string('jembatan_lebartotal');
            $table->string('jembatan_jumlahbentang');
            $table->string('nk2_kondisi_1');
            $table->string('nk2_kondisi_2');
            $table->string('nk2_kondisi_3');
            $table->string('nk2_kondisi_4');
            $table->string('nk2_kondisi_5');
            $table->string('nk2_kondisi_6');
            $table->string('nk2_kondisi_7');
            $table->string('nk2_kondisi_8');
            $table->string('nk2_kondisi_9');
            $table->string('nk2_kondisi_10');
            $table->string('nk2_aliranutama');
            $table->string('nk_bangunanbawah');
            $table->string('nk_bangunanatas');
            $table->string('nk_perlengkapan');
            $table->string('nk_gorong');
            $table->string('nk_lintasanbasah');
            $table->string('nk1_jembatan');
            $table->string('kondisi');
            $table->string('penanganan');

            $table->unsignedBigInteger('file_jembatan_id');
            $table->foreign('file_jembatan_id')
                ->references('id')
                ->on('file_jembatans');
            $table->string('status'); // Uploaded; Migrated; Deleted;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('file_db')->dropIfExists('file_jembatan_contents');
    }
};
