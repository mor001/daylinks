<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('schedule_id')->unsigned()->comment('スケジュールID');
            $table->enum('flow', ['user_to_tenant', 'tenant_to_user'])->comment('返信区分');
            $table->boolean('is_read')->comment('既読フラグ');
            $table->string('contents', 255)->comment('内容');
            $table->timestamps();
            $table->foreign('schedule_id')->references('id')->on('schedules');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
