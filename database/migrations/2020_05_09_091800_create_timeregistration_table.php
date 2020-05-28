<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeregistrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timeregistrations', function (Blueprint $table) {
            
            $table->id();
            $table->date('date')->nullable();
            $table->time('check_in')->nullable();
            $table->time('check_out')->nullable();
            $table->integer('break_time')->nullable();
            $table->time('hours_worked')->nullable();
            $table->mediumText('comments')->nullable();
            $table->boolean('approval_status')->default('0');
            $table->string('worked_hotel')->default('SetWorkplace');
            $table->integer('user_id')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timeregistrations');
    }
}
