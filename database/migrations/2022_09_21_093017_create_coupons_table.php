<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();

            $table->string( 'code' )->nullable( );
            $table->string( 'name' );
            $table->text( 'description' )->nullable( );
            $table->integer( 'uses' )->unsigned( )->nullable( );
            $table->integer( 'max_uses' )->unsigned()->nullable( );
            $table->integer( 'max_uses_user' )->unsigned( )->nullable( );
            $table->tinyInteger( 'type' )->unsigned( )->nullable();
            $table->integer( 'discount_amount' );
            $table->boolean( 'is_fixed' )->default( true );
            $table->timestamp( 'starts_at' )->nullable();
            $table->timestamp( 'expires_at' )->nullable();

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
        Schema::dropIfExists('coupons');
    }
}
