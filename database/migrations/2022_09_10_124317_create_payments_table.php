<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

//            $table->unsignedBigInteger('user_id');
//            $table->foreign('user_id')->references('id')->on('users')->onDelete('NO ACTION');

            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('NO ACTION');

            $table->string('card_name')->nullable();
            $table->string('card_number')->nullable();
            $table->string('card_cvc')->nullable();
            $table->string('card_expiry_month')->nullable();
            $table->string('card_expiry_year')->nullable();

            $table->string('payment_method'); // Stripe
            $table->string('stripe_subscription_id')->nullable();
            $table->string('stripe_customer_id')->nullable();
            $table->string('stripe_plan_id')->nullable();
            $table->float('plan_amount')->nullable();
            $table->string('plan_amount_currency')->nullable();
            $table->string('plan_interval')->nullable(); // week Or month Or year
            $table->string('plan_interval_count')->nullable();
            $table->string('payer_email')->nullable();
            $table->dateTime('created')->nullable();
            $table->dateTime('plan_period_start')->nullable();
            $table->dateTime('plan_period_end')->nullable();

            $table->string('status');
            $table->double('amount')->default('0.00');
            $table->string('result_code')->nullable();
            $table->string('stripe_token')->nullable();

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
        Schema::dropIfExists('payments');
    }
}
