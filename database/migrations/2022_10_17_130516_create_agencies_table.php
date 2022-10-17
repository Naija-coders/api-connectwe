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
        Schema::create('agencies', function (Blueprint $table) {
            $table->id();
            $table->string('agency_name', 225);
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('email');
            $table->string('agency_size');
            $table->string('about')->default('');
            $table->string('phone_number')->default('');
            $table->string('location')->default('');
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
        Schema::dropIfExists('agencies');
    }
};
