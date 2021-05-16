<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_applications', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('dob');
            $table->string('photo')->nullable();
            $table->integer('adno');
            $table->string('batch');
            $table->string('dhiu_dept');
            $table->string('dhiu_adno');
            $table->string('dhiu_batch');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('district');
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('phone_home')->nullable();
            $table->string('phone_personal');
            $table->boolean('marital_status')->default(0);
            $table->string('password');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_applications');
    }
}
