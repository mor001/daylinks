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
            $table->integer('reserve_id')->unsigned()->comment('予約ID');
            $table->enum('from_to', ['user_to_tenant', 'tenant_to_user'])->comment('送信返信区分');
            $table->boolean('is_read')->comment('既読');
            $table->string('contents', 255)->comment('内容');
            $table->timestamps();
            $table->foreign('reserve_id')->references('id')->on('reserves');
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
