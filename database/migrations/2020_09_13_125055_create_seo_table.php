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
            $table->string('meta_title')->default('Gaudeamus')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_image')->default('default-gaudeamus.jpg')->nullable();
            $table->string('og_title')->default('Gaudeamus')->nullable();
            $table->string('og_type')->default('website')->nullable();
            $table->string('og_url')->default(url('/'))->nullable();
            $table->string('og_image')->default('default-gaudeamus.jpg')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_site_name')->default('Gaudeamus')->nullable();
            $table->string('twitter_card')->default('summary')->nullable();
            $table->string('twitter_site')->default('gaudeamus')->nullable();
            $table->string('twitter_title')->default('Gaudeamus')->nullable();
            $table->text('twitter_description')->nullable();
            $table->string('twitter_creator')->default('gaudeamus')->nullable();
            $table->string('twitter_image')->default('default-gaudeamus.jpg')->nullable();
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
