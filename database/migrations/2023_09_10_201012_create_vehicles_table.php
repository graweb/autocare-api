<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('plate');
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('color')->nullable();
            $table->string('year')->nullable();
            $table->string('year_model')->nullable();
            $table->string('version')->nullable();
            $table->string('chassi')->nullable();
            $table->string('fuel')->nullable();
            $table->string('motor')->nullable();
            $table->string('nationality')->nullable();
            $table->string('uf')->nullable();
            $table->string('city')->nullable();
            $table->smallInteger('number_of_passengers')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
