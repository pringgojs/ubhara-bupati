<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DesaToJembatan extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at']; 

    public static function deleteRelatedTo($where, $to){
        DesaToJembatan::where($where, $to)->delete();
    }
}
