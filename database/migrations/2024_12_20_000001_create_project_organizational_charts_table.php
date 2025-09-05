<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectOrganizationalChartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_organizational_charts', function (Blueprint $table) {
            $table->engine = "InnoDB";
            
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->integer('manager_id')->unsigned(); // manager user id
            $table->integer('parent_id')->unsigned()->nullable(); // parent manager id
            $table->integer('position_x')->default(0);
            $table->integer('position_y')->default(0);
            $table->enum('role_type', [
                'general_manager', 
                'department_manager', 
                'executive_manager', 
                'section_supervisor', 
                'department_supervisor'
            ])->default('department_manager');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('project_id')->on('projects')->references('id')->cascadeOnDelete();
            $table->foreign('manager_id')->on('users')->references('id')->cascadeOnDelete();
            $table->foreign('parent_id')->on('project_organizational_charts')->references('id')->onDelete('set null');
            
            $table->unique(['project_id', 'manager_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_organizational_charts');
    }
}
