<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\InfrastrukturJalan;
use App\Models\KecamatanToJalan;
use Illuminate\Http\Request;

class StatusJalan extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at']; 

    public static function addStatusJalan($content, $tanggal_data){
        $jalan = InfrastrukturJalan::where('no_ruas', $content->no_ruas)->first();
        if (empty($jalan)){
            $kecamatanNames = explode('/', $content->kecamatan);
            $jalan = InfrastrukturJalan::insertFromContent($content->nama_ruas, $content->no_ruas);
            foreach($kecamatanNames as $name){
                $kecamatan = Kecamatan::where('name', 'like', '%'.$name.'%')->first();
                if (!empty($kecamatan)){
                    KecamatanToJalan::create(['kecamatan_id'=> $kecamatan->id, 'infrastruktur_jalan_id' => $jalan->id]);
                }
            }
        }
        $sj = StatusJalan::insertFromContent($jalan->id, $content, $tanggal_data);
        $jalan->status_dipakai = $sj->id;
        $jalan->save();
    }

    public static function insertFromContent($jalan_id, $content, $tanggal_data){
        $sj = new StatusJalan;
        $sj->infrastruktur_jalan_id = $jalan_id;
        $sj->status = $content->status;
        $sj->tanggal_data = $tanggal_data;
        $sj->bahan_aspal = $content->bahan_aspal;
        $sj->bahan_lapen = $content->bahan_lapen;
        $sj->bahan_rabat = $content->bahan_rabat;
        $sj->bahan_telford = $content->bahan_telford;
        $sj->bahan_tanah = $content->bahan_tanah;
        $sj->kondisi_baik = $content->kondisi_baik;
        $sj->kondisi_sedang = $content->kondisi_sedang;
        $sj->kondisi_rusakringan = $content->kondisi_rusakringan;
        $sj->kondisi_rusakberat = $content->kondisi_rusakberat;
        $sj->kondisi_total = $content->kondisi_baik + $content->kondisi_sedang + $content->kondisi_sedang + $content->kondisi_rusakringan + $content->kondisi_rusakberat;
        $sj->file_jalan_id = $content->file_jalan_id;
        $sj->save();

        return $sj;
    }

    public function updateData(Request $request){
        $this->status = $request->status;
        $this->save();

        //$infra = InfrastrukturJalan::find($this->infrastruktur_jalan_id);
        //$infra->status_dipakai = $request->status;
        //$infra->save();
    }

    public function infrastruktur()
    {
        return $this->belongsTo(InfrastrukturJalan::class, 'infrastruktur_jalan_id', 'id');
    }
}
