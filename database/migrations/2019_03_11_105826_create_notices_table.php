<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tid', 16)->comment('事業者ID');
            $table->integer('user_id')->unsigned()->comment('ユーザーID');
            $table->boolean('is_read')->comment('既読フラグ');
            $table->string('contents', 255)->comment('内容');
            $table->timestamps();
            $table->foreign('tid')->references('tid')->on('tenants');
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
        Schema::dropIfExists('notices');
    }
}
