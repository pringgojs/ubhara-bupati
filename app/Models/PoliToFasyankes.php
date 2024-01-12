<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PoliToFasyankes extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at']; 

    public static function deleteRelatedTo($where, $to){
        PoliToFasyankes::where($where, $to)->delete();
    }

    public static function changeRelatedToPoli($old, $new){
        $data = PoliToFasyankes::where('kesehatan_poli_id', $old)->get();
        foreach ($data as $key => $item) {
            $item->kesehatan_poli_id = $new;
            $item->save();
        }
    }
}
