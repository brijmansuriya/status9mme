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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username')->nullable();
            $table->string('email')->nullable();
            $table->enum('status', ['1', '0'])->default('1');
            $table->tinyInteger('notifications')->default(1);
            $table->string('full_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone')->nullable();
            $table->integer('country_code');
            $table->text('address')->nullable();
            $table->enum('device_type', ['android', 'ios'])->nullable();
            $table->enum('locale', ['en'])->default('en');
            $table->string('device_token')->nullable();
            $table->enum('social_type', ['google', 'facebook', 'apple', 'both'])->nullable();
            $table->string('social_id')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('password')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
