<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetoranPasar extends Model
{
    use HasFactory;

    public static function insertNewData($pasar, $tahun_id, $tanggal_data, $setoran){
        $sp = new SetoranPasar;
        $sp->target_setoran_id = $tahun_id; 
        $sp->setoran_terkumpul = $setoran;
        $sp->tanggal_data = $tanggal_data;
        $sp->save();
        return $sp;
    }
}
