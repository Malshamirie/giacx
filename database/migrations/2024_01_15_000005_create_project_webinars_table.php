<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectWebinarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_webinars', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->unsignedInteger('webinar_id');
            $table->timestamps();

            $table->foreign('project_id')->on('projects')->references('id')->cascadeOnDelete();
            $table->foreign('webinar_id')->on('webinars')->references('id')->cascadeOnDelete();
            
            $table->unique(['project_id', 'webinar_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_webinars');
    }
} 