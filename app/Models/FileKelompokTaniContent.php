<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileKelompokTaniContent extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'file_kelompok_tani_content';
    protected $dates = ['deleted_at']; 
    protected $connection = 'file_db';
    protected $guarded = [];

    public static function migrateKelompok($file_id){
        $file = FileKelompokTani::find($file_id);
        if (empty($file))
            return;
        $contents = FileKelompokTaniContent::where('file_kelompok_tani_id', $file_id)->get();
        foreach($contents as $content){
            $kelompok = KelompokMasyarakatTani::insertFromContent($content, $file->desa_id);
            $anggota = AnggotaKelompokMasyarakatTani::findOrInsert($content, $kelompok->id);
            $komoditas = KomoditasLahan::findOrInsert($content->komoditas);
            $jenis = JenisLahan::findOrInsert($content->jenis_lahan);
            $lahan = LahanPertanian::insertFromContent($file->desa_id, $anggota->id, $jenis->id, $komoditas->id, $content->luas_lahan);
            $content->status ='migrated';
            $content->save();
        }
        $file->status = 'migrated';
        $file->save();
    }
}
