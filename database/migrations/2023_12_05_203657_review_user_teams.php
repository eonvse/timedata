<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
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
            CREATE VIEW UserTeams AS
                SELECT
                    u.id,
                    u.surname,
                    u.name,
                    u.patronymic,
                    t.id AS tid,
                    t.name AS tname,
                    t.info AS tinfo,
                    cl.color,
                    cl.dark
                FROM
                    users u
                LEFT JOIN team_users tu ON
                    u.id = tu.user_id
                LEFT JOIN teams t ON
                    tu.team_id = t.id
                LEFT JOIN colors cl ON
                    cl.id = t.color_id
            SQL;
    }

    private function dropView(): string
    {
        return <<<SQL

            DROP VIEW IF EXISTS `UserTeams`;
            SQL;
    }
};

