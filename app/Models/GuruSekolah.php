<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GuruSekolah extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'guru_sekolahs';
    protected $dates = ['deleted_at']; 

    public static function insertNewData(Request $request){
        $data = new GuruSekolah;
        $data->nama = $request->nama;
        $data->sekolah_id = $request->sekolah_id;
        $data->mapel = $request->mapel;
        $data->tanggal_lahir = $request->tanggal_lahir;
        $data->alamat = $request->alamat;
        $data->save();
        return $data;
    }

    public static function insertFromContent($content)
    {
        $sk = Sekolah::findOrInsert($content->nama_sekolah);
        $guru = new GuruSekolah();
        $guru->nama = $content->nama_guru;
        $guru->mapel = $content->mata_pelajaran;
        $guru->tanggal_lahir = $content->tanggal_lahir;
        $guru->alamat = $content->nama_sekolah;
        $guru->sekolah_id = $sk->id;
        $guru->save();
    }

    public function updateData(Request $request){
        $this->nama = $request->nama;
        $this->sekolah_id = $request->sekolah_id;
        $this->mapel = $request->mapel;
        $this->tanggal_lahir = $request->tanggal_lahir;
        $this->alamat = $request->alamat;
        $this->save();
    }

    public static function deleteRelatedToId($id){
        GuruSekolah::where('id', $id)->delete();
    }
}
