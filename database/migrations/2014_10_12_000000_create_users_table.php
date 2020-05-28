<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone_number')->nullable();
            $table->date('date_birth')->nullable();
            $table->string('nationality')->nullable();
            $table->string('gender')->nullable();
            $table->string('adress')->nullable();
            $table->string('primary_workplace')->nullable();
            $table->string('supervisor')->nullable();
            $table->integer('contract_hours')->nullable();
            $table->date('hiring_date')->nullable();
            $table->string('employment_type')->nullable();
            $table->string('position')->nullable();
            $table->date('wp_expDate')->nullable();
            $table->mediumText('bio')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('permission_level')->default('Standard employee');
            $table->string('photo')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
