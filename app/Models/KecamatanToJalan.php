<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KecamatanToJalan extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at']; 
    protected $fillable = ['infrastruktur_jalan_id', 'kecamatan_id'];

    public function kecamatan(){
        return $this->belongsTo('App\Models\Kecamatan');
    }

    public static function deleteRelatedTo($where, $to){
        KecamatanToJalan::where($where, $to)->delete();
    }
}
