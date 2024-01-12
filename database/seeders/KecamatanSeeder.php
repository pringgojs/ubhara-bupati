<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kecamatans = ['babadan', 'badegan', 'balong', 'bungkal', 'jambon', 'jenangan', 
            'jetis', 'kauman', 'mlarak', 'ngebel', 'ngrayun', 
            'ponorogo', 'pudak', 'pulung', 'sambit','sampung',
            'sawoo', 'siman','slahung', 'sooko','sukorejo'];
        foreach($kecamatans as $kecamatan){
            DB::table('kecamatans')->insert(['name' => $kecamatan]);
        }
    }
}
