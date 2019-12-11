<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCronbachAlphasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cronbach_alphas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label', 20);
            $table->decimal('min', 12, 2)->unsigned()->default(0);
            $table->decimal('max', 12, 2)->unsigned()->default(0);
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
        Schema::dropIfExists('cronbach_alphas');
    }
}
