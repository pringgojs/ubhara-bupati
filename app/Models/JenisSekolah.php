<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisSekolah extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'jenis_sekolahs';
    protected $dates = ['deleted_at']; 

    public static function findJenjang($jenjang){
        $arr = explode(" ", $jenjang);
        $keyword = ['SD', 'MI','SMP', 'MTS','SMA', 'MA', 'SMK', 'STM'];
        $res = array_search($arr[0], $keyword);
        $jenjang = 'tk';
        if ($res !== false){
            if ($res == 0 || $res == 1)
                $jenjang = 'sd';
            else if ($res == 2 || $res == 3)
                $jenjang = 'smp';
            else if ($res == 4 || $res == 5 || $res == 6 || $res == 7)
                $jenjang = 'sma';
        }
        return $jenjang;

    }
    public static function findOrInsert($nama, $negeri, $jenjang){
        $data = JenisSekolah::where('nama', $nama)->where('negeri', $negeri)->first();
        if (empty($data)){
            $data = new JenisSekolah;
            $data->nama = $nama;
            $data->jenjang = $jenjang;
            $data->negeri = $negeri;
            $data->save();
        }
        return $data;
    }
}
