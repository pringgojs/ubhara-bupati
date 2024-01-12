<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penjual extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at']; 

    public static function deleteRelatedTo($where, $to){
        $penjuals = Penjual::where($where, $to)->get();
        $penjualId = [];
        foreach($penjuals as $penjual){
            array_push($penjualId, $penjual->id);
        }
        KomoditasPasarToPenjual::whereIn('penjual_id', $penjualId)->delete();
        Penjual::where($where, $to)->delete();
        
    }
}
