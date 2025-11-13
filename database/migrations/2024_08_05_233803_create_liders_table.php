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
        Schema::create('liders', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('lastname', 50);
            $table->date('birthdate');
            $table->string('addres', 150);
            $table->string('contact', 11);
            $table->string('code', 5);
            $table->string('foto', 100)->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('liders');
    }
};
