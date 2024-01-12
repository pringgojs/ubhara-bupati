<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(KecamatanSeeder::class);
        $this->call(DesaSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RoutesSeeder::class);
        
        $this->call(JenisSekolahSeeder::class);
        $this->call(JenisLahanSeeder::class);
        $this->call(JenisPasarSeeder::class);
        $this->call(JenisFasyankesSeeder::class);
        $this->call(KesehatanPolisSeeder::class);
    }
}
