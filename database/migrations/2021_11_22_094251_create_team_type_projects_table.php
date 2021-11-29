<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamTypeProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_type_projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id')->unsigned();
            $table->foreign('team_id')->references('id')->on('teams');
            $table->unsignedBigInteger('type_project_id')->unsigned();
            $table->foreign('type_project_id')->references('id')->on('type_projects');
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
        Schema::dropIfExists('team_type_projects');
    }
}
