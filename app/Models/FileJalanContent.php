<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\StatusJalan;

class FileJalanContent extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at']; 

    protected $connection = 'file_db';
    protected $fillable = ['no_ruas','nama_ruas','kecamatan','panjang','lebar','bahan_aspal','bahan_lapen','bahan_rabat','bahan_telford','bahan_tanah','kondisi_baik','kondisi_sedang','kondisi_rusakringan','kondisi_rusakberat','file_jalan_id', 'status'];

    public static function migrateJalan($file_id){
        $file = FileJalan::find($file_id);
        if (empty($file))
            return;
        $contents = FileJalanContent::where('file_jalan_id', $file_id)->get();
        foreach($contents as $content){
            StatusJalan::addStatusJalan($content, $file->tanggal_data);
            $content->status ='migrated';
            $content->save();
        }
        $file->status = 'migrated';
        $file->save();
    }

    public static function rollbackJalan($file_id){
        $file = FileJalan::find($file_id);
        if (empty($file))
            return;
        $contents = FileJalanContent::where('file_jalan_id', $file_id)->get();
        foreach($contents as $content){
            $jalan = InfrastrukturJalan::where('nama', $content->nama_ruas)->where('no_ruas', $content->no_ruas)->first();
            $ktj = KecamatanToJalan::where('infrastruktur_jalan_id', $jalan->id)->get();
            foreach ($ktj as $key => $value) {
                $value->delete();
            }
            $jalan->delete();
            $content->delete();
        }
        $status = StatusJalan::where('file_jalan_id', $file_id)->get();
        foreach ($status as $key => $item) {
            $item->delete();
        }
        $file->delete();
    }
}
