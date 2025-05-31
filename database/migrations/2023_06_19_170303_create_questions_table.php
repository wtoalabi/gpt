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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('intro')->nullable();
            $table->string('question');
            $table->integer('number')->default(0);
            $table->json('options')->nullable();
            $table->string('answer')->nullable();
            $table->boolean('isPureText')->default(false);
            $table->text('explain')->nullable();
            $table->string('year');

            $table->boolean('status')->default(false);

            $table->unsignedBigInteger('approved_by')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();

            $table->foreign('approved_by')->references('id')->on('staff')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('staff')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
