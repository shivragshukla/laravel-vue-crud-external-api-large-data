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
        Schema::create('properties', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->foreignId('property_type_id')->nullable()->constrained()->onUpdate('cascade');
            $table->string('county')->nullable();
            $table->string('country')->nullable();
            $table->string('town')->nullable();
            $table->text('description')->nullable();
            $table->string('address')->nullable();
            $table->string('image_full')->nullable();
            $table->string('image_thumbnail')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->integer('num_bedrooms')->nullable();
            $table->integer('num_bathrooms')->nullable();
            $table->integer('price')->nullable();
            $table->enum('type', ['sale', 'rent'])->nullable();
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
        Schema::dropIfExists('properties');
    }
};
