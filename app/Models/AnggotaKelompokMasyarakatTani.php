<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnggotaKelompokMasyarakatTani extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at']; 

    public static function insertNewData(Request $request, $id_pokmas){
        $d = new AnggotaKelompokMasyarakatTani;
        $d->kmt_id = $id_pokmas;
        $d->nama = $request->nama;
        $d->jenis_kelamin = $request->jenis_kelamin;
        $d->alamat = $request->alamat;
        $d->nik = $request->nik;
        $d->save();
        return $d;
    }

    public function updateData(Request $request){
        $this->nama = $request->nama;
        $this->jenis_kelamin = $request->jenis_kelamin;
        $this->alamat = $request->alamat;
        $this->nik = $request->nik;
        $this->save();
    }

    public static function findOrInsert($content, $kelompok_id){
        $data = AnggotaKelompokMasyarakatTani::where('nama', $content->nama_anggota)->first();
        if (empty($data)){
            $data = new AnggotaKelompokMasyarakatTani;
            $data->kmt_id = $kelompok_id;
            $data->nama = $content->nama_anggota;
            $data->jenis_kelamin = '-';
            $data->alamat = '-';
            $data->nik = $content->nik;
            $data->save();
        }
        return $data;
    }

    public static function deleteRelatedToId($id){
        AnggotaKelompokMasyarakatTani::where('id', $id)->delete();
    }
}
