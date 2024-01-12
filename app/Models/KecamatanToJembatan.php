<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KecamatanToJembatan extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at']; 
    protected $fillable = ['kecamatan_id', 'infrastruktur_jembatan_id'];

    public static function deleteRelatedTo($where, $to){
        KecamatanToJembatan::where($where, $to)->delete();
    }
}
