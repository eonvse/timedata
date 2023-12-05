<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        \DB::statement($this->dropProcedure());
       \DB::statement($this->createProcedure());

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        \DB::statement($this->dropProcedure());
        
    }

    private function createProcedure(): string
    {
        return <<<SQL
            CREATE DEFINER=`timedata`@`localhost` PROCEDURE `UserUpcomingEvents`(IN `userId` BIGINT UNSIGNED, IN `dateUp` DATE, IN `eventsCount` INT(2))
                SELECT te.id, DATE_FORMAT(te.day, '%d.%m.%Y') as day, TIME_FORMAT(te.start,'%k:%i') as start, TIME_FORMAT(te.end,'%k:%i') as `end`, te.title, t.name as tname, cl.color, cl.dark FROM time_events te 
                LEFT JOIN team_users tu on te.team_id = tu.team_id
                LEFT JOIN teams t on t.id = tu.team_id
                LEFT JOIN colors cl on cl.id = t.color_id
                WHERE tu.user_id = userId AND te.day>=dateUp
                ORDER BY te.day ASC
                LIMIT eventsCount
            SQL;
    }

    private function dropProcedure(): string
    {
        return <<<SQL

            DROP VIEW IF EXISTS `UserUpcomingEvents`;
            SQL;
    }
};
