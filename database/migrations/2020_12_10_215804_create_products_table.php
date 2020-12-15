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
            $table->id();
            $table->string('product_name');
            $table->string('slug');
            $table->string('product_img');
            $table->text('product_desc');
            $table->text('product_detail');
            $table->integer('price');
            $table->string('product_code');
            $table->integer('qty');
            $table->unsignedBigInteger('product_cat_id');
            $table->foreign('product_cat_id')->references('id')->on('product_cats')->onDelete('cascade');
            $table->unsignedBigInteger('product_sub_cat_id');
            $table->foreign('product_sub_cat_id')->references('id')->on('product_sub_cats')->onDelete('cascade');
            $table->integer('purchase')->default(0)->nullable();
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
