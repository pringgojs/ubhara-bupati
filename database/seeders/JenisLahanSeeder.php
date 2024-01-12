<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisLahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lahans = ['sawah', 'rawa', 'kebun', 'tambak', 'perikanan'];
        foreach($lahans as $lahan){
            DB::table('jenis_lahans')->insert(['nama' => $lahan]);
        }
    }
}
