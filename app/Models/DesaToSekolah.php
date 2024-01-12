<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DesaToSekolah extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at']; 

    public static function deleteRelatedTo($where, $to){
        DesaToSekolah::where($where, $to)->delete();
    }

    public static function insertFromContent($desa_kelurahan, $sekolah)
    {
        $arr = explode(" ", $desa_kelurahan);
        $ds = Desa::findOrInsert($arr[0]);
        $dts = new DesaToSekolah();
        $dts->desa_id = $ds->id;
        $dts->sekolah_id = $sekolah->id;
        $dts->save();
    }
}
