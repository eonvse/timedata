<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
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
            CREATE VIEW EventInfoVisits AS
                SELECT te.id, te.title, t.name, COALESCE(tu.all_user, 0) as all_u, COALESCE(visit.b_user,0) as b_u, (COALESCE(tu.all_user, 0)-COALESCE(visit.b_user,0)) as n_u from time_events as te
                    left join teams as t on te.team_id = t.id
                    left join (
                        SELECT team_id, COUNT(user_id) as all_user FROM team_users GROUP BY team_id
                    ) as tu on tu.team_id = t.id
                    left join (  
                        select timeEvent_id, count(user_id) as b_user FROM visits GROUp by timeEvent_id
                    ) as visit on visit.timeEvent_id = te.id
            SQL;
    }

    private function dropView(): string
    {
        return <<<SQL

            DROP VIEW IF EXISTS `EventInfoVisits`;
            SQL;
    }
};
