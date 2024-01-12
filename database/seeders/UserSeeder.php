<?php

namespace Database\Seeders;

use App\Models\Credential;
use App\Models\CredentialToRoute;
use App\Models\Route;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('cred_db')->table('credentials')->insert([
            'username' => 'admin',
            'password' => '4dm1n!!!',
            'nama' => 'admin',
            'satker' => 'Pemerintah Kab. Ponorogo',
            'deleteable' => false,
        ]);
    }
}
