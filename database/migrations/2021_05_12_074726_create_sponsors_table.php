<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSponsorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsors', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->index();
            $table->integer('campaign_id')->unsigned()->index();
            $table->string('name');
            $table->string('place');
            $table->string('phone');
            $table->string('whatsapp')->nullable();
            $table->double('amount');
            $table->boolean('amount_received')->default(false);
            $table->tinyInteger('mode')->default(1); // 1: Cash / 2: Bank transfer
            $table->string('transaction_id')->nullable(); // only available
            $table->string('bank')->nullable();
            $table->string('receipt_no')->nullable();
            $table->boolean('verification')->default(false); // office use only
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sponsors');
    }
}
