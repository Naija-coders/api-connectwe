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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title', 225);
            $table->foreignId('categories_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreignId('tags_id')->references('id')->on('tags')->onDelete('cascade');
            $table->string('overview');
            $table->string('location_type');
            $table->string('location');
            $table->foreignId('price_id')->references('id')->on('prices')->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('privacy');
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
        Schema::dropIfExists('projects');
    }
};
