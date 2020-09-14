<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageContentTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_content_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();

            $table->unsignedBigInteger('page_content_id');
            $table->unique(['page_content_id', 'locale']);
            $table->foreign('page_content_id')->references('id')->on('page_content')->onDelete('cascade');

            $table->string('title');
            $table->string('description');
            $table->string('link_title')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_content_translations');
    }
}
