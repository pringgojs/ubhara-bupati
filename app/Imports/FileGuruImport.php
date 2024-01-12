<?php

namespace App\Imports;

use App\Models\FileGuruContent;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class FileGuruImport implements ToCollection
{
    public $file_guru_id;
    public function __construct($file_id){
        $this->file_guru_id = $file_id;
    }

    public function collection(Collection $rows)
    {
        $iter = 0;
        foreach($rows as $row){
            if($iter > 0){
    
                $tgl = Date::excelToDateTimeObject($row[3]);
                
                FileGuruContent::create([
                    'nama_guru' => $row[1],
                    'desa_kelurahan' => $row[2],
                    'tanggal_lahir' => $tgl,
                    'mata_pelajaran' => $row[4],
                    'nama_sekolah' => $row[5],
                    'status_guru' => $row[6],
                    'file_guru_id' => $this->file_guru_id,
                    'status' => 'uploaded'
                ]);
            }
            $iter++;
        }
    }
}
