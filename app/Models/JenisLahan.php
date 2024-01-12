<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisLahan extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'jenis_lahans';
    protected $dates = ['deleted_at']; 

    public static function findOrInsert($nama){
        $data = JenisLahan::where('nama', $nama)->first();
        if (empty($data)){
            $data = new JenisLahan;
            $data->nama = $nama;
            $data->save();
        }
        return $data;
    }
}
