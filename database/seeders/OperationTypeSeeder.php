<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OperationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('operation_types')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('operation_types')->insert([
            ['name' => 'INSERT', 'desc'=>'Создано'],
            ['name' => 'UPDATE', 'desc'=>'Обновлено'],
            ['name' => 'DELETE', 'desc'=>'Удалено'],
        ]);
        //
    }
}
