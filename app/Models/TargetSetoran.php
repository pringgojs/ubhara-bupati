<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetSetoran extends Model
{

    use HasFactory;

    public static function insertNewData($pasar, $tahun_anggaran, $target){
        $ts = new TargetSetoran;
        $ts->pasar_id = $pasar->id;
        $ts->tahun_anggaran = $tahun_anggaran;
        $ts->target = $target;
        $ts->save();
        return $ts;
    }

    public static function deleteRelatedToId($id){
        SetoranPasar::where('target_setoran_id', $id)->delete();
        TargetSetoran::where('id', $id)->delete();
    }
}
