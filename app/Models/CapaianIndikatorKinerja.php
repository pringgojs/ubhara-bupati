<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CapaianIndikatorKinerja extends Model
{
    use HasFactory;

    public static function insertFromRequest(Request $request, $indikator_id){
        $c = new CapaianIndikatorKinerja;
        $c->tahun = $request->tahun;
        $c->target = $request->target;
        $c->capaian = $request->capaian;
        $c->satuan = $request->satuan;
        $c->indikator_kinerja_id = $indikator_id;
        $c->save();
    }
}
