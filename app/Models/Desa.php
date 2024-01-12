<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Kecamatan;

class Desa extends Model
{
    use HasFactory, SoftDeletes;
    protected $connection = 'mysql';

    protected $dates = ['deleted_at']; 

    public static function findOrInsert($alamat){
        $desa = Desa::where('name', strtolower($alamat))->first();
        if (empty($desa)){
            $kecamatan = Kecamatan::findOrInsert('-');
            $desa = new Desa;
            $desa->kecamatan_id = $kecamatan->id;
            $desa->name = $alamat;
            $desa->save();
        }
        return $desa;
    }
    public static function insertNewData(Request $request){
        if (!Kecamatan::find($request->kecamatan_id))
            return;
        $desa = new Desa;
        $desa->kecamatan_id = $request->kecamatan_id;
        $desa->name = strtoupper($request->name);
        $desa->luas = $request->luas;
        $desa->lurah = $request->lurah;
        $desa->alamat_lurah = $request->alamat_lurah;
        $desa->telp_lurah = $request->telp_lurah;
        $desa->save();
        return $desa;
    }

    public function updateData(Request $request){
        $this->kecamatan_id = $request->kecamatan_id;
        $this->name = $request->name;
        $this->luas = $request->luas;
        $this->lurah = $request->lurah;
        $this->alamat_lurah = $request->alamat_lurah;
        $this->telp_lurah = $request->telp_lurah;
        $this->save();
    }

    public static function getDataWithKecamatan(){
        return Desa::leftJoin('kecamatans', 'desas.kecamatan_id', 'kecamatans.id')
            ->orderBy('desas.name')
            ->select('desas.*', 'kecamatans.name as kecamatan')
            ->get();
    }

    public function kecamatan(){
        return $this->belongsTo('App\Models\Kecamatan');
    }
}
