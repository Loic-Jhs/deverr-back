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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('developer_id')->nullable();
            $table->unsignedBigInteger('developer_prestation_id')->nullable();
            $table->string('instructions', 1500)->nullable();
            $table->boolean('is_paid')->default(0);
            $table->boolean('is_accepted_by_developer')->default(0)->nullable();
            $table->string('stripe_session_id')->nullable();
            $table->string('reference')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('developer_id')->references('id')->on('developers')->onDelete('set null');
            $table->foreign('developer_prestation_id')->references('id')->on('developer_prestations')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
