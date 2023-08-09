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

            $table->integer('subscription_id')->nullable();

            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('order_number')->default(random_int(1000, 9999))->nullable();
            $table->enum('status', ['On_Hold', 'Done'])->nullable()->default('On_Hold');

            $table->double('discount')->nullable();
            $table->double('total')->nullable(); // price

            $table->string('service_title')->nullable(); // btn_name

            $table->boolean('is_agree_terms_and_conditions')->default(1)->nullable();
            $table->boolean('is_active_image')->default(1)->nullable();
            $table->string('language')->nullable();

            $table->string('your_image')->nullable();
            $table->string('other_image')->nullable();

            $table->string('your_field')->nullable();
            $table->string('other_field')->nullable();

            $table->integer('match_ratio')->nullable();

            $table->text('description')->nullable();

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
        Schema::dropIfExists('orders');
    }
}
