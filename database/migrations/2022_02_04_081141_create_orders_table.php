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
            $table->increments('id');
            $table->decimal('cost', 8,2);
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->integer('orderstatuses_id')->unsigned();
            $table->string('city');
            $table->string('address');
            $table->string('country');
            $table->string('phone');
            $table->string('date');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('orderstatuses_id')->references('id')->on('orderstatuses')->onDelete('cascade');
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
