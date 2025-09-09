<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebinarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webinars', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('teacher_id')->unsigned();
            $table->integer('project_id')->unsigned();
            $table->integer('creator_user_id')->unsigned();
            $table->string('title', 64);
            $table->integer('start_date');
            $table->integer('end_date');
            $table->string('image_cover');
            $table->string('video_demo')->nullable();
            $table->integer('capacity')->unsigned();
            $table->float('price', 15, 3)->unsigned();
            $table->text('description')->nullable();
            $table->boolean('support')->default(false);
            $table->boolean('partner_instructor')->default(false);
            $table->boolean('subscribe')->default(false);
            $table->text('message_for_reviewer')->nullable();
            $table->enum('status', ['active', 'pending', 'is_draft', 'inactive']);

            // نوع الدورة (حضوري أو عن بعد)
            $table->enum('training_type', ['in_person', 'online'])->default('online');
            
            // بيانات التدريب الحضوري
            $table->string('training_location_name')->nullable(); // اسم المكان
            $table->integer('training_date')->nullable(); // التاريخ
            $table->string('training_time')->nullable(); // الساعة
            $table->text('training_location_link')->nullable(); // رابط اللوكيشن
            
            // بيانات التدريب عن بعد
            $table->text('online_training_link')->nullable(); // رابط التدريب
            $table->integer('online_link_activation_date')->nullable(); // موعد تفعيل الرابط
            
            // موافقة التسجيل
            $table->enum('registration_approval', ['manual', 'automatic'])->default('automatic');
            
            // نوع الشهادة
            $table->enum('certificate_type', ['attendance', 'accredited_attendance'])->default('attendance');

            $table->integer('created_at');
            $table->integer('updated_at')->nullable();
            $table->integer('deleted_at')->nullable();

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('creator_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('webinars');
    }
}
