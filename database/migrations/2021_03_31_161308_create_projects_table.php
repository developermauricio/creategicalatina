<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->text('description_short');
            $table->string('link');
            $table->string('picture');
            $table->string('video');
            $table->date('end_time')->nullable();
            $table->unsignedBigInteger('type_project_id')->nullable();
            $table->foreign('type_project_id')->references('id')->on('type_projects');
            $table->unsignedBigInteger('project_category_id')->nullable();
            $table->foreign('project_category_id')->references('id')->on('project_categories');
            $table->string('slug')->nullable();
            $table->enum('state', [
                \App\Model\Project::ACTIVE,
                \App\Model\Project::INACTIVE
            ])->default(\App\Model\Project::ACTIVE);
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
        Schema::dropIfExists('projects');
    }
}
