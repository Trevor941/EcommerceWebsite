<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->string('SKU');
            $table->string('stock')->nullable();
            $table->integer('tag_id')->unsigned()->nullable();
            $table->decimal('regularprice', 10,2);
            $table->integer('product_colors_id')->unsigned();
            $table->integer('product_sizes_id')->unsigned();
            $table->decimal('saleprice', 10,2)->nullable();
            $table->integer('published');
            // $table->integer('quantity');
            $table->string('featuredimage');
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
        Schema::dropIfExists('products');
    }
}
