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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->datetime('datetime');
            $table->integer('assistant_amount');
            $table->integer('visit_amount');
            $table->decimal('offering', 10, 7);
            $table->integer('payment_method')->comment('0:efectivo, 1:qr');
            $table->string('voucher')->nullable();
            $table->string('assistant');
            $table->string('visit');
            $table->unsignedBigInteger('celula_id');
            $table->foreign('celula_id')->references('id')->on('celulas')->onDelete('cascade');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
