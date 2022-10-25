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
        Schema::table('developer_prestations', function (Blueprint $table) {
            $table->foreign('prestation_type_id')->references('id')->on('prestation_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('developer_prestations', function (Blueprint $table) {
            $table->dropForeign(['prestation_type_id']);
        });
    }
};
