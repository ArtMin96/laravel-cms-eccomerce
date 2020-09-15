<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();

            $table->unsignedBigInteger('settings_id');
            $table->unique(['settings_id', 'locale']);
            $table->foreign('settings_id')->references('id')->on('settings')->onDelete('cascade');

            $table->string('title');
            $table->string('address');
            $table->string('footer_title');
            $table->text('footer_description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings_translations');
    }
}
