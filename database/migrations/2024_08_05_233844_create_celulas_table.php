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
        Schema::create('celulas', function (Blueprint $table) {
            $table->id();
            $table->integer('number');
            $table->string('addres');
            $table->integer('day');
            $table->time('hour');
            $table->decimal('latitude', 10, 7);
            $table->decimal('length', 10, 7);
            $table->unsignedBigInteger('lider_id');
            $table->foreign('lider_id')->references('id')->on('liders')->onDelete('cascade');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('celulas');
    }
};
