<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MuridSekolah extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at']; 

    public static function insertNewData(Request $request){
        $data = new MuridSekolah;
        $data->kelas = $request->kelas;
        $data->sekolah_id = $request->sekolah_id;
        $data->jumlah = $request->jumlah;
        $data->tahun_ajaran = $request->tahun_ajaran;
        $data->save();
        return $data;
    }

    public function updateData(Request $request){
        $this->kelas = $request->kelas;
        $this->sekolah_id = $request->sekolah_id;
        $this->jumlah = $request->jumlah;
        $this->tahun_ajaran = $request->tahun_ajaran;
        $this->save();
    }

    public static function deleteRelatedToId($id){
        MuridSekolah::where('id', $id)->delete();
    }

    public static function insertFromContent($content, $jenjang)
    {
        $sk = Sekolah::findOrInsert2($content->nama_sekolah, $content->jenis_sekolah, $content->desa_kelurahan, $jenjang);

        if($jenjang=="TK") {
            for ($i=0; $i<2; $i++) { 
                $murid = new MuridSekolah();
                if($i==0){
                    $murid->kelas = "Kelas A";
                    $murid->jumlah = $content->kelas_1;
                } elseif($i==1){
                    $murid->kelas = "Kelas B";
                    $murid->jumlah = $content->kelas_2;
                } 
                $murid->tahun_ajaran = $content->tahun_ajaran;
                $murid->sekolah_id = $sk->id;
                $murid->save();
            }
        } elseif($jenjang=="SD") {
            for ($i=0; $i<6; $i++) { 
                $murid = new MuridSekolah();
                if($i==0){
                    $murid->kelas = "Kelas 1";
                    $murid->jumlah = $content->kelas_1;
                } elseif($i==1){
                    $murid->kelas = "Kelas 2";
                    $murid->jumlah = $content->kelas_2;
                } elseif($i==2){
                    $murid->kelas = "Kelas 3";
                    $murid->jumlah = $content->kelas_3;
                } elseif($i==3){
                    $murid->kelas = "Kelas 4";
                    $murid->jumlah = $content->kelas_4;
                } elseif($i==4){
                    $murid->kelas = "Kelas 5";
                    $murid->jumlah = $content->kelas_5;
                } elseif($i==5){
                    $murid->kelas = "Kelas 6";
                    $murid->jumlah = $content->kelas_6;
                } 
                $murid->tahun_ajaran = $content->tahun_ajaran;
                $murid->sekolah_id = $sk->id;
                $murid->save();
            }
        } elseif($jenjang=="SMP") {
            for ($i=0; $i<3; $i++) { 
                $murid = new MuridSekolah();
                if($i==0){
                    $murid->kelas = "Kelas 7";
                    $murid->jumlah = $content->kelas_1;
                } elseif($i==1){
                    $murid->kelas = "Kelas 8";
                    $murid->jumlah = $content->kelas_2;
                } elseif($i==2){
                    $murid->kelas = "Kelas 9";
                    $murid->jumlah = $content->kelas_3;
                }
                $murid->tahun_ajaran = $content->tahun_ajaran;
                $murid->sekolah_id = $sk->id;
                $murid->save();
            }
        }

    
    }
}
