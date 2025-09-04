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
        Schema::create('webinar_participants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('webinar_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('project_id');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();

            // Foreign keys
            $table->foreign('webinar_id')->references('id')->on('webinars')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');

            // Indexes
            $table->index(['webinar_id', 'user_id']);
            $table->index(['project_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('webinar_participants');
    }
};
