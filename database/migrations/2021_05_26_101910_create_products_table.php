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
            $table->text('title');
            $table->text('description');
            $table->float('price');
            $table->float('old_price')->nullable();
            $table->integer('amount');
            $table->string('brand');
            $table->text('photos');
            $table->boolean('liquid');
            $table->boolean('hard');
            $table->boolean('wet');
            $table->boolean('warm');
            $table->boolean('deleted')->default(false);
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
