<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kecamatan extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'kecamatans';
    protected $dates = ['deleted_at']; 

    public static function findOrInsert($name){
        $kecamatan = Kecamatan::where('name', $name)->first();
        if(empty($kecamatan)){
            $kecamatan = new Kecamatan;
            $kecamatan->name = $name;
            $kecamatan->save();
        }
        return $kecamatan;
    }
    public static function insertNewData(Request $request){
        $kecamatan = new Kecamatan;
        $kecamatan->name = $request->name;
        $kecamatan->luas = $request->luas;
        $kecamatan->camat = $request->camat;
        $kecamatan->nip = $request->nip;
        $kecamatan->alamat_camat = $request->alamat_camat;
        $kecamatan->telp_camat = $request->telp_camat;
        $kecamatan->save();
        return $kecamatan;
    }

    public function updateData(Request $request){
        $this->name = $request->name;
        $this->luas = $request->luas;
        $this->camat = $request->camat;
        $this->nip = $request->nip;
        $this->alamat_camat = $request->alamat_camat;
        $this->telp_camat = $request->telp_camat;
        $this->save();
    }

    public function uploadFoto($foto){
        $path = $foto->store('kecamatan');
        $this->foto = $path;
        $this->save();
    }

    public function desa(){
    	return $this->hasMany('App\Models\Desa');
    }
}
