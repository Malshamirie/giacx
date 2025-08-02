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

            $table->bigIncrements('id');
            $table->bigInteger('project_id')->unsigned(); // تغيير إلى bigInteger
            $table->string('file_path'); // مسار الملف
            $table->string('file_name'); // اسم الملف الأصلي
            $table->string('file_type'); // نوع الملف
            $table->integer('file_size')->unsigned(); // حجم الملف
            $table->integer('created_at')->unsigned();

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