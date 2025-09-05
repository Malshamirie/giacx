<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectManagerConnectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_manager_connections', function (Blueprint $table) {
            $table->engine = "InnoDB";
            
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->integer('from_manager_id')->unsigned();
            $table->integer('to_manager_id')->unsigned();
            $table->enum('connection_type', [
                'collaboration', 
                'reporting', 
                'coordination'
            ])->default('collaboration');
            $table->timestamps();

            $table->foreign('project_id')->on('projects')->references('id')->cascadeOnDelete();
            $table->foreign('from_manager_id')->on('users')->references('id')->cascadeOnDelete();
            $table->foreign('to_manager_id')->on('users')->references('id')->cascadeOnDelete();
            
            $table->unique(['project_id', 'from_manager_id', 'to_manager_id'], 'pmc_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_manager_connections');
    }
}
