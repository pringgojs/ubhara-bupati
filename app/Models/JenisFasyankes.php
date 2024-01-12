<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisFasyankes extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'jenis_fasyankes';
    protected $dates = ['deleted_at']; 

    protected $fillable = ['nama'];

    public static function findOrInsert($nama){
        $jenis = JenisFasyankes::where('nama', $nama)->first();
        if (empty($jenis)){
            $jenis = new JenisFasyankes;
            $jenis->nama = $nama;
            $jenis->save();
        }
        return $jenis;
    }
}
