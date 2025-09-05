<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_categories', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('parent_id')->nullable();
            $table->string('slug')->nullable();
            $table->string('title')->nullable();
            $table->string('icon')->nullable();
            $table->integer('order')->unsigned()->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });

        Schema::create('quiz_category_translations', function (Blueprint $table) {
            $table->engine = "InnoDB";

            $table->bigIncrements('id');
            $table->unsignedInteger('quiz_category_id');
            $table->string('locale', 191)->index();
            $table->string('title');

            $table->foreign('quiz_category_id', 'quiz_category_id')->on('quiz_categories')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_category_translations');
        Schema::dropIfExists('quiz_categories');
    }
}