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
            $table->integer('schedule_id')->comment('スケジュールID');
            $table->integer('user_id')->comment('ユーザーID');
            $table->time('leave_school_time')->nullable()->comment('下校時間');
            $table->enum('status', ['accept', 'reserved', 'cancel'])->nullable()->comment('ステータス');
            $table->softDeletes();
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
        Schema::dropIfExists('reserves');
    }
}
