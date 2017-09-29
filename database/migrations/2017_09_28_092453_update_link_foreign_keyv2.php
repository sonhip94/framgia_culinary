<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateLinkForeignKeyv2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->foreign('level_id')->references('id')->on('level')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
        Schema::table('receipts', function ($table) {
            $table->foreign('level_id')->references('id')->on('level')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
            $table->dropForeign("level_id");
            $table->dropColumn('level_id');
        });
        Schema::table('receipts', function($table) {
            $table->dropForeign("level_id");
            $table->dropColumn('level_id');
        });
    }
}
