<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        
        $this->call([
            ShieldSeeder::class,
            SettingSeeder::class,
            UserSeeder::class,
            ProvinceSeeder::class,
        ]);
        
        Artisan::call('shield:generate', ['--all' => true, '--panel' => 'admin']);

    }
}
