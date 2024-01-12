<?php

namespace App\Imports;

use App\Models\FileSekolahContent;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class FileSekolahImport implements ToCollection
{
    public $file_sekolah_id;
    public function __construct($file_id){
        $this->file_sekolah_id = $file_id;
    }

    public function collection(Collection $rows)
    {
        $iter = 0;
        foreach($rows as $row){
            if($iter > 0){
                FileSekolahContent::create([
                    'nama_sekolah' => $row[1],
                    'desa_kelurahan' => $row[2],
                    'jenjang' => $row[3],
                    'kondisi' => $row[4],
                    'file_sekolah_id' => $this->file_sekolah_id,
                    'status' => 'uploaded'
                ]);
            }
            $iter++;
        }
    }
}
