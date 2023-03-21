<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStateFieldToUsersAndApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('state')->after('mother_name')->default('Kerala');
        });
        Schema::table('user_applications', function (Blueprint $table) {
            $table->string('state')->after('mother_name')->default('Kerala');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('state');
        });
        
        Schema::table('user_applications', function (Blueprint $table) {
            $table->dropColumn('state');
        });
    }
}
