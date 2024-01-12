<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\InfrastrukturJembatan;
use App\Models\Kecamatan;
use App\Models\kecamatanToJembatan;
use Illuminate\Http\Request;

class StatusJembatan extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at']; 

    public static function addStatusJembatan($content, $tanggal_data){
        $jembatan = InfrastrukturJembatan::where('nomor', $content->jembatan_nobaru)->first();
        if (empty($jembatan)){
            $kecamatanNames = explode('/', $content->jembatan_kecamatan);
            $jembatan = InfrastrukturJembatan::insertFromContent($content->jembatan_nama, $content->jembatan_nobaru);
            foreach($kecamatanNames as $name){
                $kecamatan = Kecamatan::where('name', 'like', '%'.$name.'%')->first();
                if (!empty($kecamatan)){
                    KecamatanToJembatan::create(['kecamatan_id'=> $kecamatan->id, 'infrastruktur_jembatan_id' => $jembatan->id]);
                }
            }
        }
        $sj = StatusJembatan::insertFromContent($jembatan->id, $content, $tanggal_data);
        $jembatan->status_dipakai = $sj->id;
        $jembatan->save();
    }

    public static function insertFromContent($jembatan_id, $content, $tanggal_data){
        $sj = new StatusJembatan;
        $sj->status = $content->status;
        $sj->tanggal_data = $tanggal_data;
        $sj->infrastruktur_jembatan_id = $jembatan_id;
        $sj->ruasjalan_no = $content->ruasjalan_no;
        $sj->jembatan_nolama = $content->jembatan_nolama;
        $sj->jembatan_nobaru = $content->jembatan_nobaru;
        $sj->ruasjalan_panjang = $content->ruasjalan_panjang;
        $sj->ruasjalan_nama = $content->ruasjalan_nama;
        $sj->jembatan_nourut = $content->jembatan_nourut;
        $sj->jembatan_nama = $content->jembatan_nama;
        $sj->koordinat_x = $content->koordinat_x;
        $sj->koordinat_y = $content->koordinat_y;
        $sj->pal_km = $content->pal_km;
        $sj->tipe_struktur = $content->tipe_struktur;
        $sj->tipe_penyeberangan = $content->tipe_penyeberangan;
        $sj->jembatan_panjang = $content->jembatan_panjang;
        $sj->jembatan_lebarjalur = $content->jembatan_lebarjalur;
        $sj->jembatan_lebartotal = $content->jembatan_lebartotal;
        $sj->jembatan_jumlahbentang = $content->jembatan_jumlahbentang;
        $sj->nk2_kondisi_1 = $content->nk2_kondisi_1;
        $sj->nk2_kondisi_2 = $content->nk2_kondisi_2;
        $sj->nk2_kondisi_3 = $content->nk2_kondisi_3;
        $sj->nk2_kondisi_4 = $content->nk2_kondisi_4;
        $sj->nk2_kondisi_5 = $content->nk2_kondisi_5;
        $sj->nk2_kondisi_6 = $content->nk2_kondisi_6;
        $sj->nk2_kondisi_7 = $content->nk2_kondisi_7;
        $sj->nk2_kondisi_8 = $content->nk2_kondisi_8;
        $sj->nk2_kondisi_9 = $content->nk2_kondisi_9;
        $sj->nk2_kondisi_10 = $content->nk2_kondisi_10;
        $sj->nk2_aliranutama = $content->nk2_aliranutama;
        $sj->nk_bangunanbawah = $content->nk_bangunanbawah;
        $sj->nk_bangunanatas = $content->nk_bangunanatas;
        $sj->nk_perlengkapan = $content->nk_perlengkapan;
        $sj->nk_gorong = $content->nk_gorong;
        $sj->nk_lintasanbasah = $content->nk_lintasanbasah;
        $sj->nk1_jembatan = $content->nk1_jembatan;
        $sj->kondisi = $content->kondisi;
        $sj->penanganan = $content->penanganan;
        $sj->save();

        return $sj;
    }

    public function updateData(Request $request){
        $this->status = $request->status;
        $this->save();

        //$infra = InfrastrukturJembatan::find($this->infrastruktur_jembatan_id);
        //$infra->status_dipakai = $request->status;
        //$infra->save();
    }

    public function infrastruktur()
    {
        return $this->belongsTo(InfrastrukturJembatan::class, 'infrastruktur_jembatan_id', 'id');
    }
}
