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
            $table->integer('register')->unsigned()->comment('登録者');
            $table->dateTime('publish')->comment('公開日時');
            $table->enum('status', ['open', 'closed'])->comment('ステータス');
            $table->timestamps();
            $table->unique(['tid', 'date']);
            $table->foreign('register')->references('id')->on('staff');
            $table->foreign('tid')->references('tid')->on('tenants');
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
