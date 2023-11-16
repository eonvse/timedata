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
            CREATE TRIGGER `before_delete_user` BEFORE DELETE ON `users` 
            FOR EACH ROW BEGIN
                DELETE FROM information WHERE (information.item_id = OLD.id AND information.type_id = 4);

                DELETE FROM files WHERE (files.item_id = OLD.id AND files.type_id = 4);

                DELETE FROM team_users WHERE (user_id = OLD.id);

                DELETE FROM visits WHERE (user_id = OLD.id);

                SET @p0='DELETE'; SET @p1='users'; SET @p2='0'; SET @p3=OLD.id; SET @p4='0'; SET @p5='0'; SET @p6=CONCAT('Удален пользователь ',OLD.id,' ',OLD.name,' (',OLD.email,')'); 

                CALL `sendNotification`(@p0, @p1, @p2, @p3, @p4, @p5, @p6);
                END
            SQL;
    }

    private function dropTrigger(): string
    {
        return <<<SQL

            DROP TRIGGER IF EXISTS `before_delete_user`;
            SQL;
    }
};
