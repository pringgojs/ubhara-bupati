<?php

namespace App\Imports;

use App\Models\FileKelompokTaniContent;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class FileKelompokTaniImport implements ToCollection
{
    public $file_kelompok_tani_id;
    public function __construct($file_id){
        $this->file_kelompok_tani_id = $file_id;
    }

    public function collection(Collection $rows)
    {
        $iter = 0;
        foreach($rows as $row){
            if($iter > 0){
                FileKelompokTaniContent::create([
                    'nama_anggota' => $row[1],
                    'nik' => $row[2],
                    'nama_kelompok' => $row[3],
                    'luas_lahan' => $row[4],
                    'jenis_lahan' => $row[5],
                    'komoditas' => $row[6],
                    'file_kelompok_tani_id' => $this->file_kelompok_tani_id,
                    'status' => 'uploaded'
                ]);
            }
            $iter++;
        }
    }
}
