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
        Schema::create('staff_wallets', function (Blueprint $table) {
            $table->id();
            $table->integer('balance')->default(0);
            $table->integer('threshold')->default(0);
            $table->boolean('status')->default(false);
            
            $table->unsignedBigInteger('staff')->nullable();
            $table->foreign('staff')->references('id')->on('staff')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_wallets');
    }
};
