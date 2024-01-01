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
        Schema::create('explorers', function (Blueprint $table) {
            $table->id();
            $table->text('keywords')->nullable();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('meta_description');
            $table->text('description');
            $table->string('image')->nullable();
            $table->enum('status', ['0', '1'])->default('1');
            $table->timestamps();

            //set index status
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('explorers');
    }
};
