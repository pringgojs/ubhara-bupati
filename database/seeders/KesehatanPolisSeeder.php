<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KesehatanPolisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $polis = ['umum', 'anak', 'kia', 'jiwa'];
        foreach($polis as $poli){
            DB::table('kesehatan_polis')->insert(['nama' => $poli]);
        }
    }
}
