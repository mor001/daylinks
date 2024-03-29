<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->comment('ユーザーID');
            $table->integer('schedule_id')->unsigned()->nullable()->comment('スケジュールID');
            $table->boolean('is_read')->comment('既読フラグ');
            $table->string('contents', 255)->comment('内容');
            $table->enum('destination', ['0', '1'])->comment('宛先 0:ユーザーから事業者へ 1:事業者からユーザーへ');
            $table->integer('reply_id')->unsigned()->nullable()->comment('返信先ID');
            $table->timestamps();
            $table->foreign('schedule_id')->references('id')->on('schedules');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('reply_id')->references('id')->on('contacts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
