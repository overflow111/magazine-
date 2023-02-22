<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ip_address_id')->index();
            $table->foreign('ip_address_id')->references('id')->on('ip_addresses')->onDelete('cascade');
            $table->unsignedBigInteger('user_agent_id')->index();
            $table->foreign('user_agent_id')->references('id')->on('user_agents')->onDelete('cascade');
            $table->integer('hits')->default(1);
            $table->integer('suspect_hits')->default(0);
            $table->boolean('robot')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitors');
    }
}
