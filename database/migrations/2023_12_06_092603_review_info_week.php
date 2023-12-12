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

        \DB::statement($this->dropView());
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
            CREATE VIEW EventInfoWeek AS
                SELECT te.id, te.title, te.day, te.start, te.end,t.id as tid, t.name, COALESCE(tu.all_user, 0) as all_u, COALESCE(visit.b_user,0) as b_u, (COALESCE(tu.all_user, 0)-COALESCE(visit.b_user,0)) as n_u, notes.last_note, cl.color, cl.dark, COALESCE(inf.count_note,0) as notes, COALESCE(fl.count_file,0) as files 
                    from time_events as te
                    left join teams as t on te.team_id = t.id
                    left join (
                        SELECT team_id, COUNT(user_id) as all_user FROM team_users GROUP BY team_id
                    ) as tu on tu.team_id = t.id
                    left join (  
                        select timeEvent_id, count(user_id) as b_user FROM visits GROUp by timeEvent_id
                    ) as visit on visit.timeEvent_id = te.id
                    left JOIN (select item_id, note as last_note from information 
                                    join (
                                            select max(id) max_id from information group by item_id
                                        ) max_ids on max_id = id
                                        where type_id = 3
                    ) as notes on notes.item_id = te.id
                    left join colors as cl on t.color_id = cl.id
                    left join (select item_id, count(note) as count_note from information where type_id=3 group by item_id) as inf on inf.item_id = te.id
                    left join (select item_id, count(url) as count_file from files where type_id=3 group by item_id) as fl on fl.item_id = te.id
            SQL;
    }

    private function dropView(): string
    {
        return <<<SQL

            DROP VIEW IF EXISTS `EventInfoWeek`;
            SQL;
    }
};
