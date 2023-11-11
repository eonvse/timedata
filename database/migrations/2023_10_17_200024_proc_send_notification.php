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
            CREATE DEFINER=`timedata`@`localhost` PROCEDURE `sendNotification`(IN `operation_name` VARCHAR(255) CHARSET utf8mb4, IN `model_name` VARCHAR(255) CHARSET utf8mb4, IN `autor_id` BIGINT UNSIGNED, IN `model_item_id` BIGINT UNSIGNED, IN `week` SMALLINT UNSIGNED, IN `year` SMALLINT UNSIGNED, IN `message` TEXT)
            BEGIN
                DECLARE operation_id BIGINT UNSIGNED;
                DECLARE model_id BIGINT UNSIGNED;
               
                SELECT id INTO operation_id FROM operation_types WHERE operation_types.name = CONVERT(operation_name USING utf8);
                
                SELECT id INTO model_id FROM model_types WHERE model_types.model = CONVERT(model_name USING utf8);
                
            INSERT notifications(operation_id, autor_id, model_type_id , model_item_id, week, `year`, message, created_at, updated_at) 
                    VALUES (operation_id, autor_id, model_id, model_item_id, week, year, message, NOW(),NOW());

                
            END
            SQL;
    }

    private function dropProcedure(): string
    {
        return <<<SQL

            DROP VIEW IF EXISTS `EventInfoVisits`;
            SQL;
    }
};
