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
            $table->string('pincode');
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
            $table->string('stripe_id')->nullable()->index();
            $table->string('pm_type')->nullable();
            $table->string('pm_last_four', 4)->nullable();
            $table->timestamp('trial_ends_at')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_country_code')->nullable();
            $table->string('website')->nullable();
            $table->string('company_phone')->nullable();
            $table->string('company_email')->nullable();
            $table->string('country_id')->nullable();
            $table->string('city')->nullable();
            $table->string('title')->nullable();
            $table->string('other_title')->nullable();
            $table->string('booth_number')->nullable();
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
