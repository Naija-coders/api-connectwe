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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categories_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreignId('images_id')->references('id')->on('images')->onDelete('cascade');
            $table->foreignId('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('tags_id')->references('id')->on('tags')->onDelete('cascade');
            $table->string('overview')->default('');
            $table->string('description')->default('');
            $table->string('delivery_time')->default('');
            $table->string('privacy')->default('');
            $table->string('pitch')->default('');
            $table->foreignId('price_id')->references('id')->on('service_prices')->onDelete('cascade');

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
        Schema::dropIfExists('services');
    }
};
