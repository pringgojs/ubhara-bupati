<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisFasyankesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jenises = ['puskesmas', 'rumah sakit tipe a', 'rumah sakit tipe b', 'rumah sakit tipe c', 'rumah sakit tipe d', 'puskesmas pembantu'];
        foreach($jenises as $jenis){
            DB::table('jenis_fasyankes')->insert(['nama' => $jenis]);
        }
    }
}
