<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LahanPertanian extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at']; 
    
    public static function insertFromContent($desa_id, $anggota_id, $jenis_lahan_id, $komoditas_id,$luas){
        $lp = new LahanPertanian;
        $lp->desa_id = $desa_id;
        $lp->anggota_kelompok_masyarakat_tani_id = $anggota_id;
        $lp->jenis_lahan_id = $jenis_lahan_id;
        $lp->komoditas_lahan_id = $komoditas_id;
        $lp->luas = $luas;
        $lp->save();
        return $lp;
    }
}
