<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterpretationTypeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inter_type_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();

            $table->unsignedBigInteger('inter_type_id');
            $table->unique(['inter_type_id', 'locale']);
            $table->foreign('inter_type_id')->references('id')->on('inter_type')->onDelete('cascade');

            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inter_type_translations');
    }
}
