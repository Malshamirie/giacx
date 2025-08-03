<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_files', function (Blueprint $table) {
            $table->engine = "InnoDB";

            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->string('file_path'); // مسار الملف
            $table->string('file_name')->nullable(); // اسم الملف الأصلي
            $table->string('file_type')->nullable(); // نوع الملف
            $table->integer('file_size')->unsigned()->nullable(); // حجم الملف
            $table->timestamps();

            $table->foreign('project_id')->on('projects')->references('id')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_files');
    }
} 