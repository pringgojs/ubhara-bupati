<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use App\Models\FileNakesContent;

class FileNakesImport implements ToCollection
{
    public $file_nakes_id;
    public function __construct($file_nakes_id){
        $this->file_nakes_id = $file_nakes_id;
    }
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        //
        $iter = 0;
        foreach($rows as $row){
            if($iter > 0){
                FileNakesContent::create([
                    //
                    'nama' => $row[0],
                    'kepegawaian' => $row[1],
                    'jabatan' => $row[2],
                    'penempatan' => $row[3],
                    'fasyankes' => $row[4],
                    'alamat_nakes' => $row[5],
                    'alamat_fasyankes' => $row[6],
                    'jenis_fasyankes' => $row[7],
                    'file_nakes_id' => $this->file_nakes_id,
                    'status' => 'uploaded'
                ]);
            }
            $iter++;
        }
    }
}
