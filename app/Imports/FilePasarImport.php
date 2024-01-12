<?php

namespace App\Imports;

use App\Models\FilePasarContent;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class FilePasarImport implements ToCollection
{
    public $file_jalan_id;
    public function __construct($file_id){
        $this->file_jalan_id = $file_id;
    }

    public function collection(Collection $rows)
    {
        $iter = 0;
        foreach($rows as $row){
            if($iter > 0){
                FilePasarContent::create([
                    'no_ruas' => $row[0],
                    'nama_ruas' => $row[1],
                    'kecamatan' => $row[2],
                    'panjang' => $row[3],
                    'lebar' => $row[4],
                    'bahan_aspal' => $row[5],
                    'bahan_lapen' => $row[6],
                    'bahan_rabat' => $row[7],
                    'bahan_telford' => $row[8],
                    'bahan_tanah' => $row[9],
                    'kondisi_baik' => $row[10],
                    'kondisi_sedang' => $row[11],
                    'kondisi_rusakringan' => $row[12],
                    'kondisi_rusakberat' => $row[13],
                    'file_jalan_id' => $this->file_jalan_id,
                    'status' => 'uploaded'
                ]);
            }
            $iter++;
        }
    }
}
