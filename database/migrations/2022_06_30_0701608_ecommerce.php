<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
Schema::create('confirm_order', function (Blueprint $table) {
    $table->bigIncrements('CO_id');
    
    $table->string('Payment_type');
    $table->string('Shipping_place');
    
    $table->unsignedBigInteger('P_id');
    $table->foreign('P_id')->references('P_id')->on('Products');

    $table->unsignedBigInteger('C_id');
    $table->foreign('C_id')->references('C_id')->on('Customers');


});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
