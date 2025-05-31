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
        Schema::create('staff_withdrawals', function (Blueprint $table) {
            $table->id();

            $table->integer('amount');
            $table->enum('status', ['Pending', 'Cancelled', 'Successful'])->default('Pending');
            
            $table->unsignedBigInteger('staff')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->unsignedBigInteger('bank_id')->nullable();

            $table->foreign('staff')->references('id')->on('staff')->onDelete('cascade');
            $table->foreign('approved_by')->references('id')->on('staff')->onDelete('cascade');
            $table->foreign('bank_id')->references('id')->on('staff_banks')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_withdrawals');
    }
};
