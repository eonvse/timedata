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
            CREATE DEFINER=`timedata`@`localhost` PROCEDURE `getEventStatisticsForPeriod`(IN `dateStart` DATE, IN `dateEnd` DATE)
                    SELECT 
                        group1.week, 
                        SUM(group1.events) as event_sum, 
                        COUNT(group1.team_id) as teams_count, 
                        SUM(group1.user_count) as users_sum, 
                        SUM(group1.plan) as visits_plan,
                        SUM(group1.missing) as visits_missing  
                        FROM
                            (SELECT WEEKOFYEAR(es.day)as week,es.team_id,count(es.timeEvent_id) as events, max(es.user_count) as user_count,(max(es.user_count)*count(es.timeEvent_id)) as plan, sum(missing) as missing FROM EventStatistics es
                                where (es.day BETWEEN dateStart AND dateEnd)
                                GROUP BY WEEKOFYEAR(es.day), es.team_id) as group1
                    GROUP BY group1.week
            SQL;
    }

    private function dropProcedure(): string
    {
        return <<<SQL

            DROP VIEW IF EXISTS `getEventStatisticsForPeriod`;
            SQL;
    }
};
