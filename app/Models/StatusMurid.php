<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\InfrastrukturJembatan;
use App\Models\Kecamatan;
use App\Models\kecamatanToJembatan;

class StatusMurid extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'status_murid';
    protected $dates = ['deleted_at']; 

    public static function addStatusKomoditas($content, $tanggal_data){
        $data = InfrastrukturJembatan::where('nomor', $content->jembatan_nobaru)->first();
        if (empty($data)){
            $kecamatanNames = explode('/', $content->jembatan_kecamatan);
            $jembatan = InfrastrukturJembatan::insertFromContent($content->jembatan_nama, $content->jembatan_nama);
            foreach($kecamatanNames as $name){
                $kecamatan = Kecamatan::where('name', 'like', '%'.$name.'%')->first();
                if (!empty($kecamatan)){
                    KecamatanToJembatan::create(['kecamatan_id'=> $kecamatan->id, 'infrastruktur_jembatan_id' => $jembatan->id]);
                }
            }
        }
        $sj = StatusMurid::insertFromContent($data->id, $content, $tanggal_data);
        $data->status_dipakai = $sj->id;
        $data->save();
    }

    public static function insertFromContent($id, $content, $tanggal_data){
        $sj = new StatusMurid;
       
        $sj->save();
        return $sj;
    }
}
