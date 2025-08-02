<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddManagersCountToGroupsRegistrationPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('groups_registration_packages', function (Blueprint $table) {
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
        Schema::table('groups_registration_packages', function (Blueprint $table) {
            $table->dropColumn('managers_count');
        });
    }
} 