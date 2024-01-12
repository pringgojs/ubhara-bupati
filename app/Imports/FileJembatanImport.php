<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\Models\FileJembatanContent;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;

class FileJembatanImport implements ToCollection, SkipsOnError, SkipsOnFailure
{
    use SkipsErrors, SkipsFailures;

    public $file_jembatan_id;
    public function __construct($file_jembatan_id){
        $this->file_jembatan_id = $file_jembatan_id;
    }
    
    public function collection(Collection $collection)
    {
        $iter = 0;
        foreach($collection as $row){
            if($iter > 0){
                FileJembatanContent::create([
                    'ruasjalan_no' => $row[0],
                    'jembatan_nolama' => $row[1],
                    'jembatan_nobaru' => $row[2],
                    'ruasjalan_panjang' => $row[3],
                    'ruasjalan_nama' => $row[4],
                    'jembatan_nourut' => $row[5],
                    'jembatan_nama' => $row[6],
                    'jalan_kecamatan' => $row[7],
                    'jembatan_kecamatan' => $row[8],
                    'koordinat_x' => $row[9],
                    'koordinat_y' => $row[10],
                    'pal_km' => $row[11],
                    'tipe_struktur' => $row[12],
                    'tipe_penyeberangan' => $row[13],
                    'jembatan_panjang' => $row[14],
                    'jembatan_lebarjalur' => $row[15],
                    'jembatan_lebartotal' => $row[16],
                    'jembatan_jumlahbentang' => $row[17],
                    'nk2_kondisi_1' => $row[18],
                    'nk2_kondisi_2' => $row[19],
                    'nk2_kondisi_3' => $row[20],
                    'nk2_kondisi_4' => $row[21],
                    'nk2_kondisi_5' => $row[22],
                    'nk2_kondisi_6' => $row[23],
                    'nk2_kondisi_7' => $row[24],
                    'nk2_kondisi_8' => $row[25],
                    'nk2_kondisi_9' => $row[26],
                    'nk2_kondisi_10' => $row[27],
                    'nk2_aliranutama' => $row[28],
                    'nk_bangunanbawah' => $row[29],
                    'nk_bangunanatas' => $row[30],
                    'nk_perlengkapan' => $row[31],
                    'nk_gorong' => $row[32],
                    'nk_lintasanbasah' => $row[33],
                    'nk1_jembatan' => $row[34],
                    'kondisi' => $row[35],
                    'penanganan' => $row[36],
                    'file_jembatan_id' => $this->file_jembatan_id,
                    'status' => 'uploaded'
                ]);
            }
            $iter++;
        }
    }
}
