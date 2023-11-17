<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    public function up(): void
    {

       \DB::statement($this->createView());

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        \DB::statement($this->dropView());
        
    }

    private function createView(): string
    {
        return <<<SQL
            CREATE VIEW EventStatistics AS
                SELECT
                    WEEK(te.day, 3) AS WEEK,
                    te.id AS timeEvent_id,
                    te.day AS day,
                    te.team_id AS team_id,
                    cu.user_count AS user_count,
                    COALESCE(vt.visit_count, 0) AS visit_count,
                    GREATEST(cu.user_count - COALESCE(vt.visit_count, 0),0) AS missing
                FROM timedata.time_events te
                LEFT JOIN(
                    SELECT 
                        tu.team_id AS team_id,
                        COUNT(tu.user_id) AS user_count
                    FROM
                        timedata.team_users tu
                    GROUP BY
                        tu.team_id
                        ) cu
                    ON cu.team_id = te.team_id
                LEFT JOIN(
                    SELECT
                        v.timeEvent_id AS timeEvent_id,
                        COUNT(v.user_id) AS visit_count
                    FROM
                        timedata.visits v
                    GROUP BY
                        v.timeEvent_id
                    ) vt
                ON vt.timeEvent_id = te.id
            SQL;
    }

    private function dropView(): string
    {
        return <<<SQL

            DROP VIEW IF EXISTS `EventStatistics`;
            SQL;
    }
};

