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
        Schema::create('explorers_posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('explorer_id');
            $table->unsignedBigInteger('post_id');
            $table->timestamps();
            //forien key
            $table->foreign('explorer_id')->references('id')->on('explorers');
            $table->foreign('post_id')->references('id')->on('posts');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('explorers_posts');
    }
};
