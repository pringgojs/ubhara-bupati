<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Fasyankes;
use App\Models\KesehatanPoli;

class TenagaKesehatan extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at']; 

    public static function insertNewData(Request $request){
        $ptf = PoliToFasyankes::where('fasyankes_id', $request->fasyankes_id)->first();
        $data = new TenagaKesehatan;
        $data->nama = $request->nama;
        $data->fasyankes_id = $request->fasyankes_id;
        $data->kepegawaian = $request->kepegawaian;
        $data->jabatan = $request->jabatan;
        $data->alamat = $request->alamat;
        $data->kesehatan_poli_id = $ptf->kesehatan_poli_id;
        $data->save();
        return $data;
    }

    public function updateData(Request $request){
        $this->nama = $request->nama;
        $this->fasyankes_id = $request->fasyankes_id;
        $this->kepegawaian = $request->kepegawaian;
        $this->jabatan = $request->jabatan;
        $this->alamat = $request->alamat;
        $this->save();
    }

    public static function insertFromContent($content){
        $fasyankes = Fasyankes::findOrInsert($content->fasyankes, $content->jenis_fasyankes, $content->alamat_fasyankes);
        $poli = KesehatanPoli::findOrInsert($content->penempatan);
        $nakes = new TenagaKesehatan;
        $nakes->nama = $content->nama;
        $nakes->kepegawaian = $content->kepegawaian;
        $nakes->jabatan = $content->jabatan;
        $nakes->alamat = $content->alamat_nakes;
        $nakes->fasyankes_id = $fasyankes->id;
        $nakes->kesehatan_poli_id = $poli->id;
        $nakes->save();
    }

    public static function deleteRelatedToId($id){
        TenagaKesehatan::where('id', $id)->delete();
    }
}
