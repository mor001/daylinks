<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tid', 16)->comment('事業者ID');
            $table->string('userid', 16)->comment('ユーザーID');
            $table->string('name')->comment('氏名');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->comment('パスワード');
            $table->enum('isAdmin', ['0', '1'])->comment('管理者権限');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['tid', 'userid']);
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
        Schema::dropIfExists('staff');
    }
}
