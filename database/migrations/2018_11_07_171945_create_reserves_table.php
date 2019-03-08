<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserves', function (Blueprint $table) {
            $table->increments('id')->comment('ID');
            $table->integer('schedule_id')->unsigned()->comment('スケジュールID');
            $table->integer('user_id')->unsigned()->comment('ユーザーID');
            $table->time('leave_school_time')->nullable()->comment('下校時間');
            $table->enum('status', ['accept', 'reserved', 'cancel'])->nullable()->comment('ステータス');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('schedule_id')->references('id')->on('schedules');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reserves');
    }
}
