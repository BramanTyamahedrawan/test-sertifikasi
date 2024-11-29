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
        Schema::create('letter', function (Blueprint $table) {
            $table->id();
            $table->string('letter_number');
            $table->unsignedBigInteger('category_id');
            $table->string('name');
            $table->string('file');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letter');
    }
};
