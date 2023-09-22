<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModelTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('model_types')->insert([
            ['model' => 'teams', 'name'=>'Группы'],
            ['model' => 'team_users', 'name'=>'Участники группы'],
            ['model' => 'time_events', 'name'=>'События'],
            ['model' => 'users', 'name'=>'Участники'],
            ['model' => 'week', 'name'=>'Неделя'],
            
        ]);
    }
}
