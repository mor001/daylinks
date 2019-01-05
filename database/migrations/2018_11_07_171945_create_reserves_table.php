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
            $table->string('tid', 16)->comment('事業者ID');
            $table->integer('schedule_id')->comment('スケジュールID');
            $table->integer('user_id')->comment('ユーザーID');
            $table->time('leave_school_time')->nullable()->comment('下校時間');
            $table->enum('use', ['放課後利用','一日利用'])->comment('利用形態');
            $table->enum('status', ['未予約','予約受付','予約確定','予約キャンセル'])->comment('ステータス');
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
