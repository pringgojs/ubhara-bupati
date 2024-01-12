<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class IndikatorKinerja extends Model
{
    use HasFactory;

    public static function insertFromRequest(Request $request){
        $ik = new IndikatorKinerja;
        $ik->aspek = $request->aspek;
        $ik->skpd = $request->skpd;
        $ik->sumber = $request->sumber;
        $ik->keterangan = $request->keterangan;
        $ik->indikator_kinerja_group_id = $request->indikator_id;
        $ik->save();
    }
}
