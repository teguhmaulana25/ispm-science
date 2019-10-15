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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('username', 140)->unique();
            $table->string('email', 140)->unique()->index();
            $table->string('password');
            $table->tinyInteger('status')->unsigned()->default(0)->comment('0:inactive; 1:active;');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('created_by', 140)->comment('user email');
            $table->string('updated_by', 140)->comment('user email');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
