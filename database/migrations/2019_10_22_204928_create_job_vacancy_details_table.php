<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobVacancyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_vacancy_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('job_vacancy_id');
            $table->unsignedInteger('criteria_detail_id');
            $table->decimal('value', 12, 2)->unsigned()->default(0);
            $table->tinyInteger('status')->unsigned()->default(0)->comment('0:inactive; 1:active;');
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
        Schema::dropIfExists('job_vacancy_details');
    }
}
