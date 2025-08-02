<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddManagersCountToUsersRegistrationPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_registration_packages', function (Blueprint $table) {
            $table->integer('managers_count')->nullable()->after('students_count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_registration_packages', function (Blueprint $table) {
            $table->dropColumn('managers_count');
        });
    }
} 