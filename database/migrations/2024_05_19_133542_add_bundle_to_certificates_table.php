<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('certificates', function (Blueprint $table) {
            DB::statement("ALTER TABLE `certificates` MODIFY COLUMN `type` enum('quiz', 'course', 'bundle') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL AFTER `user_grade`");

            $table->integer('bundle_id')->unsigned()->nullable()->after('webinar_id');

            $table->foreign('bundle_id')->on('bundles')->references('id')->cascadeOnDelete();
        });

        // إضافة عمود type إلى جدول certificates_templates
        Schema::table('certificates_templates', function (Blueprint $table) {
            $table->enum('type', ['quiz', 'course', 'bundle'])->default('course')->after('image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->dropForeign(['bundle_id']);
            $table->dropColumn('bundle_id');
        });

        Schema::table('certificates_templates', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
