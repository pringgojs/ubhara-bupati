<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisPasarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = ['Pasar Tradisional', 'Pasar Modern', 'Pasar Harian', 'Pasar Mingguan', 'Pasar Temporer', 'Pasar Induk'];
        foreach($datas as $data){
            DB::table('jenis_pasars')->insert(['nama' => $data]);
        }
    }
}
