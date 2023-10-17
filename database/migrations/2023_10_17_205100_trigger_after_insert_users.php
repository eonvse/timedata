<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
      
        mysql -u root -p

        mysql> set global log_bin_trust_function_creators=1;
        mysql> show variables like '%log_bin_trust_function_creators%';

     */
    public function up(): void
    {

       \DB::unprepared($this->createTrigger());

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        \DB::unprepared($this->dropTrigger());
        
    }

    private function createTrigger(): string
    {
        return <<<SQL
            CREATE TRIGGER `addNullVisitNewUser` AFTER INSERT ON `users`
            FOR EACH ROW insert into visits (user_id, timeEvent_id, autor_id) VALUES(NEW.id,0,0)
            SQL;
    }

    private function dropTrigger(): string
    {
        return <<<SQL

            DROP TRIGGER IF EXISTS `addNullVisitNewUser`;
            SQL;
    }
};