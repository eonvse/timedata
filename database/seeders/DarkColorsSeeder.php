<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DarkColorsSeeder extends Seeder
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
            ['color' => '_clean', 'dark' => '_clean'],
            ['color' => 'bg-gray-100', 'dark' => 'bg-gray-200'],
            ['color' => 'bg-gray-300', 'dark' => 'bg-gray-600'],
            ['color' => 'bg-red-100', 'dark' => 'bg-red-200'],
            ['color' => 'bg-red-300', 'dark' => 'bg-red-600'],
            ['color' => 'bg-orange-100', 'dark' => 'bg-orange-200'],
            ['color' => 'bg-orange-300', 'dark' => 'bg-orange-600'],
            ['color' => 'bg-yellow-100', 'dark' => 'bg-yellow-200'],
            ['color' => 'bg-yellow-300', 'dark' => 'bg-yellow-600'],
            ['color' => 'bg-lime-100', 'dark' => 'bg-lime-200'],
            ['color' => 'bg-lime-300', 'dark' => 'bg-lime-600'],
            ['color' => 'bg-green-100', 'dark' => 'bg-green-200'],
            ['color' => 'bg-green-300', 'dark' => 'bg-green-600'],
            ['color' => 'bg-cyan-100', 'dark' => 'bg-cyan-200'],
            ['color' => 'bg-cyan-300', 'dark' => 'bg-cyan-600'],
            ['color' => 'bg-sky-100', 'dark' => 'bg-sky-200'],
            ['color' => 'bg-sky-300', 'dark' => 'bg-sky-600'],
            ['color' => 'bg-indigo-100', 'dark' => 'bg-indigo-200'],
            ['color' => 'bg-indigo-300', 'dark' => 'bg-indigo-600'],
            ['color' => 'bg-fuchsia-100', 'dark' => 'bg-fuchsia-200'],
            ['color' => 'bg-fuchsia-300', 'dark' => 'bg-fuchsia-600'],
        ]);
    }
}
