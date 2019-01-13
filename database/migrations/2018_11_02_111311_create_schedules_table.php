<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id')->comment('ID');;
            $table->string('tid', 16)->comment('事業者ID');
            $table->date('date')->comment('日付');
            $table->string('title', 255)->comment('タイトル');
            $table->text('description')->comment('説明');
            $table->integer('register')->comment('登録者');
            $table->timestamps();
            $table->unique(['tid', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
