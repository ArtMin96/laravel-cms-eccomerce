<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_request', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_id');
            $table->string('name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('email');
            $table->integer('field_expertise');
            $table->integer('year_expertise');
            $table->bigInteger('translated_page_number');
            $table->bigInteger('daily_translation_capacity');
            $table->integer('translator_type')->nullable();
            $table->decimal('translation_rate_per_page')->nullable();
            $table->decimal('monthly_salary_expectation')->nullable();
            $table->string('cv');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_request');
    }
}
