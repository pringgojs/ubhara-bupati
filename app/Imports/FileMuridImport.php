<?php

namespace App\Imports;

use App\Models\FileMuridContent;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class FileMuridImport implements ToCollection
{
    public $file_murid_id, $jenjang;
    public function __construct($file_id, $jenjang){
        $this->file_murid_id = $file_id;
        $this->jenjang = $jenjang;
    }

    public function collection(Collection $rows)
    {
        $iter = 0;
        if($this->jenjang == "TK") {
            foreach($rows as $row){
                if($iter > 0){
                    FileMuridContent::create([
                        'nama_sekolah' => $row[1],
                        'jenis_sekolah' => $row[2],
                        'desa_kelurahan' => $row[3],
                        'tahun_ajaran' => $row[4],
                        'kelas_1' => $row[5],
                        'kelas_2' => $row[6],
                        'file_murid_id' => $this->file_murid_id,
                        'status' => 'uploaded'
                    ]);
                }
                $iter++;
            }
        }
        else if($this->jenjang == "SD") {
            foreach($rows as $row){
                if($iter > 0){
                    FileMuridContent::create([
                        'nama_sekolah' => $row[1],
                        'jenis_sekolah' => $row[2],
                        'desa_kelurahan' => $row[3],
                        'tahun_ajaran' => $row[4],
                        'kelas_1' => $row[5],
                        'kelas_2' => $row[6],
                        'kelas_3' => $row[7],
                        'kelas_4' => $row[8],
                        'kelas_5' => $row[9],
                        'kelas_6' => $row[10],
                        'file_murid_id' => $this->file_murid_id,
                        'status' => 'uploaded'
                    ]);
                }
                $iter++;
            }
        }
        else if($this->jenjang == "SMP") {
            foreach($rows as $row){
                if($iter > 0){
                    FileMuridContent::create([
                        'nama_sekolah' => $row[1],
                        'jenis_sekolah' => $row[2],
                        'desa_kelurahan' => $row[3],
                        'tahun_ajaran' => $row[4],
                        'kelas_1' => $row[5],
                        'kelas_2' => $row[6],
                        'kelas_3' => $row[7],
                        'file_murid_id' => $this->file_murid_id,
                        'status' => 'uploaded'
                    ]);
                }
                $iter++;
            }
        }
        
    }
}
