<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {

      // \DB::statement($this->createTrigger());

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

      //  \DB::statement($this->dropTrigger());
        
    }

    private function createTrigger(): string
    {
        return <<<SQL
            CREATE TRIGGER `AfterInsertUser` AFTER INSERT ON `users`
                FOR EACH ROW INSERT INTO visits (timeEvent_id, user_id, autor_id, created_at, updated_at )
                    VALUES (0,NEW.id,0,NOW(),NOW())
            SQL;
    }

    private function dropTrigger(): string
    {
        return <<<SQL

            DROP TRIGGER IF EXISTS `AfterInsertUser`
            SQL;
    }


};
