<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('colors')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('colors')->insert([
            ['color' => '_clean'],
            ['color' => 'bg-gray-100'],
            ['color' => 'bg-gray-300'],
            ['color' => 'bg-red-100'],
            ['color' => 'bg-red-300'],
            ['color' => 'bg-orange-100'],
            ['color' => 'bg-orange-300'],
            ['color' => 'bg-yellow-100'],
            ['color' => 'bg-yellow-300'],
            ['color' => 'bg-lime-100'],
            ['color' => 'bg-lime-300'],
            ['color' => 'bg-green-100'],
            ['color' => 'bg-green-300'],
            ['color' => 'bg-cyan-100'],
            ['color' => 'bg-cyan-300'],
            ['color' => 'bg-sky-100'],
            ['color' => 'bg-sky-300'],
            ['color' => 'bg-indigo-100'],
            ['color' => 'bg-indigo-300'],
            ['color' => 'bg-fuchsia-100'],
            ['color' => 'bg-fuchsia-300'],
        ]);

    }
}
