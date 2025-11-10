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
            $table->string('photo')->nullable();
            $table->unsignedBigInteger('celula_id');
            $table->foreign('celula_id')->references('id')->on('celulas')->onDelete('cascade');
            $table->boolean('status')->default(1);
            $table->string('name_celula', 50)->nullable();
            $table->string('address', 250)->nullable();
            $table->string('lider', 150)->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('length', 10, 7)->nullable();
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
