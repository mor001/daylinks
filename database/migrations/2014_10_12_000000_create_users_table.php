<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tid', 16)->comment('事業者ID');
            $table->string('userid', 16)->comment('ユーザーID');
            $table->string('name')->comment('氏名');
            $table->string('email')->unique()->nullable()->comment('メールアドレス');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->comment('パスワード');
            $table->integer('limit')->comment('利用日数');
            $table->text ('usernote')->nullable()->comment('ユーザー備考');
            $table->text ('tenantnote')->nullable()->comment('事業者備考');
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
        Schema::dropIfExists('users');
    }
}
