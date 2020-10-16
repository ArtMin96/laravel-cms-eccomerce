<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCredentialsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credentials_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();

            $table->unsignedBigInteger('credentials_id');
            $table->unique(['credentials_id', 'locale']);
            $table->foreign('credentials_id')->references('id')->on('credentials')->onDelete('cascade');

            $table->string('name');
            $table->text('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('credentials_translations');
    }
}
