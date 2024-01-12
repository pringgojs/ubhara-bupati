<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileJembatanContent extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at']; 
    protected $connection = 'file_db';
    protected $fillable =['ruasjalan_no','jembatan_nolama','jembatan_nobaru','ruasjalan_panjang','ruasjalan_nama','jembatan_nourut','jembatan_nama','jalan_kecamatan','jembatan_kecamatan','koordinat_x','koordinat_y','pal_km','tipe_struktur','tipe_penyeberangan','jembatan_panjang','jembatan_lebarjalur','jembatan_lebartotal','jembatan_jumlahbentang','nk2_kondisi_1','nk2_kondisi_2','nk2_kondisi_3','nk2_kondisi_4','nk2_kondisi_5','nk2_kondisi_6','nk2_kondisi_7','nk2_kondisi_8','nk2_kondisi_9','nk2_kondisi_10','nk2_aliranutama','nk_bangunanbawah','nk_bangunanatas','nk_perlengkapan','nk_gorong','nk_lintasanbasah','nk1_jembatan','kondisi','penanganan','file_jembatan_id','status'];

    public static function migrateJembatan($file_id) {
        $file = FileJembatan::find($file_id);
        if (empty($file))
            return;
        $contents = FileJembatanContent::where('file_jembatan_id', $file_id)->get();
        foreach($contents as $content){
            StatusJembatan::addStatusJembatan($content, $file->tanggal_data);
            $content->status ='migrated';
            $content->save();
        }
        $file->status = 'migrated';
        $file->save();
    }

    public static function rollbackJembatan($file_id) {
        $file = FileJembatan::find($file_id);
        if (empty($file))
            return;
        $contents = FileJembatanContent::where('file_jembatan_id', $file_id)->get();
        foreach($contents as $content){
            $jembatan = InfrastrukturJembatan::where('nama', $content->jembatan_nama)->where('nomor', $content->jembatan_nobaru)->first();
            $ktj = KecamatanToJembatan::where('infrastruktur_jembatan_id', $jembatan->id)->get();
            $status = StatusJembatan::where('infrastruktur_jembatan_id', $jembatan->id)->first();
            foreach ($ktj as $key => $value) {
                $value->delete();
            }
            $status->delete();
            $jembatan->delete();
            $content->delete();

        }
        $file->delete();
    }

}
