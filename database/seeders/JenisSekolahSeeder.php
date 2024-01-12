<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisSekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jenjangs = ['TK', 'PAUD', 'SD', 'MI', 'SMP', 'MTS', 'SMA', 'SMK', 'MA'];
        $jenises = ['TK', 'PAUD', 'Sekolah Dasar', 'Madrasah Ibtidaiah', 'Sekolah Menengah Pertama', 'Madrasah Tsanawiyah', 'Sekolah Menengah Atas', 'Sekolah Menengah Kejuruan', 'Madrasah Aliyah'];
        foreach($jenises as $key => $value){
            DB::table('jenis_sekolahs')->insert([
                'nama' => $jenises[$key],
                'negeri' => true,
                'jenjang' => $jenjangs[$key]
            ]);
            DB::table('jenis_sekolahs')->insert([
                'nama' => $jenises[$key],
                'negeri' => false,
                'jenjang' => $jenjangs[$key]
            ]); 
        }

        DB::table('jenis_sekolahs')->insert([
            'id' => 99,
            'nama' => 'Undefined',
            'negeri' => false
        ]);
    }
}
