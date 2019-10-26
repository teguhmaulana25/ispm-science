<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCronbachAlpasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cronbach_alpas', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('start_value', 12, 2)->unsigned()->default(0);
            $table->decimal('end_value', 12, 2)->unsigned()->default(0);
            $table->string('value', 45);
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
        Schema::dropIfExists('cronbach_alpas');
    }
}
