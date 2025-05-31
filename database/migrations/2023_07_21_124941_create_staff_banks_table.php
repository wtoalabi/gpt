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
        Schema::create('staff_banks', function (Blueprint $table) {
            $table->id();

            $table->string('bank_name');
            $table->unsignedBigInteger('account_number');
            $table->string('account_name');
            $table->boolean('default')->default(0);
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
        Schema::dropIfExists('staff_banks');
    }
};
