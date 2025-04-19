<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Model::unguard();

        DB::unprepared(File::get(database_path('sql/provinces.sql')));
        DB::unprepared(File::get(database_path('sql/cities.sql')));
        DB::unprepared(File::get(database_path('sql/countries.sql')));
    }
}
