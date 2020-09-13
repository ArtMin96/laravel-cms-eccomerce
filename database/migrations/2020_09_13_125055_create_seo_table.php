<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('page_id');
            $table->string('meta_title');
            $table->text('meta_keywords');
            $table->text('meta_description');
            $table->string('meta_image');
            $table->string('og_title');
            $table->string('og_type');
            $table->string('og_url');
            $table->string('og_image');
            $table->text('og_description');
            $table->string('og_site_name');
            $table->string('fb_admins');
            $table->string('twitter_card');
            $table->string('twitter_site');
            $table->string('twitter_title');
            $table->text('twitter_description');
            $table->string('twitter_creator');
            $table->string('twitter_image');
            $table->timestamps();

            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seo');
    }
}
