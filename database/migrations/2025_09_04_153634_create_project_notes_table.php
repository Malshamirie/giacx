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
        Schema::create('project_notes', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->text('content');
            $table->timestamps();

            $table->foreign('project_id')->on('projects')->references('id')->cascadeOnDelete();
            $table->foreign('user_id')->on('users')->references('id')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_notes');
    }
};
