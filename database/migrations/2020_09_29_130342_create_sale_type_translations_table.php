<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleTypeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_type_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();

            $table->unsignedBigInteger('sale_type_id');
            $table->unique(['sale_type_id', 'locale']);
            $table->foreign('sale_type_id')->references('id')->on('sale_type')->onDelete('cascade');

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
        Schema::dropIfExists('sale_type_translations');
    }
}
