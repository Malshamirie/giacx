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
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('organization_id')->unsigned(); // تغيير إلى bigInteger
            $table->string('name'); // اسم المشروع
            $table->enum('field', ['training', 'consulting', 'other_services']); // مجال المشروع
            $table->date('start_date'); // تاريخ البداية
            $table->date('end_date'); // تاريخ النهاية
            $table->string('slug')->unique(); // slug لصفحة الهبوط
            
            // مدراء المشروع
            $table->integer('project_manager_id')->unsigned(); // تغيير إلى bigInteger
            $table->integer('project_coordinator_id')->unsigned()->nullable(); // تغيير إلى bigInteger
            $table->integer('project_consultant_id')->unsigned()->nullable(); // تغيير إلى bigInteger
            
            // الخدمات
            $table->enum('venue_type', ['hotel', 'client_venue', 'center_venue']); // مكان تنفيذ المشروع
            $table->enum('logistics_services', ['coffee_break', 'lunch', 'other']); // الخدمات اللوجستية
            
            // تعليمات إضافية
            $table->text('instructions')->nullable(); // تعليمات حول المشروع
            
            $table->enum('status', ['draft', 'active', 'completed', 'cancelled'])->default('draft');
            $table->timestamps();
            $table->foreign('organization_id')->on('users')->references('id')->cascadeOnDelete();
            $table->foreign('project_manager_id')->on('users')->references('id')->cascadeOnDelete();
            $table->foreign('project_coordinator_id')->on('users')->references('id')->cascadeOnDelete();
            $table->foreign('project_consultant_id')->on('users')->references('id')->cascadeOnDelete();
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