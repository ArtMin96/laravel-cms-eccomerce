<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->decimal('grand_total', 10, 2)->default(0);
            $table->unsignedInteger('item_count');

            $table->boolean('payment_status')->default(1);
            $table->smallInteger('payment_method')->nullable();

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->integer('is_delivery')->default(0);
            $table->text('address')->nullable();
            $table->string('phone_number');
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
        Schema::dropIfExists('orders');
    }
}
