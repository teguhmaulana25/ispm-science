<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('job_vacancy_id');
            $table->unsignedInteger('cronbach_alpha_id')->nullable();
            $table->string('name', 40);
            $table->string('birth_place', 40);
            $table->date('birth_date');
            $table->string('email', 140);
            $table->string('phone', 24);
            $table->text('address')->nullable();
            $table->date('interview_date')->nullable();
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
        Schema::dropIfExists('candidates');
    }
}
