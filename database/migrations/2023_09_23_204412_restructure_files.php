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
        Schema::table('files', function (Blueprint $table) {
            $table->dropColumn('info_id');
            $table->unsignedBigInteger('autor_id');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('item_id')->nullable();
            $table->unsignedSmallInteger('week')->nullable();
            $table->unsignedSmallInteger('year')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('files', function (Blueprint $table) {
            //
        });
    }
};
