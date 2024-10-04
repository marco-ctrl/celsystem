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
        Schema::create('send_mail_invitations', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('token')->unique();
            $table->boolean('status')->default(1)->comment('0:expired, 1:vigente');
            $table->unsignedBigInteger('lider_id');
            $table->foreign('lider_id')->references('id')->on('liders')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('send_mail_invitations');
    }
};
