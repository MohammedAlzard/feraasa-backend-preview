<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderServiceFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_service_fields', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

            $table->string('your_image')->nullable();
            $table->string('other_image')->nullable();

            $table->longText('dream_description')->nullable();

            $table->string('is_agree_show_photo')->default(1)->nullable();

            $table->string('name')->nullable();
            $table->string('gender')->nullable();
            $table->integer('age')->nullable();
            $table->string('status')->nullable();
            $table->string('other_name')->nullable();
            $table->string('other_gender')->nullable();
            $table->integer('other_age')->nullable();
            $table->string('other_status')->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('order_service_fields');
    }
}
