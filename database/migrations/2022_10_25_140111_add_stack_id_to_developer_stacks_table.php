<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('developer_stacks', function (Blueprint $table) {
            $table->foreign('stack_id')->references('id')->on('stacks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('developer_stacks', function (Blueprint $table) {
            $table->dropForeign(['stack_id']);
        });
    }
};
