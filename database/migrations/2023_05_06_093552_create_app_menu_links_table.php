<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_menu_links', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('show_name');
            $table->enum('for', ['user']);
            $table->enum('type', ['ckeditor', 'normal', 'file']);
            $table->longText('value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_menu_links');
    }
};
