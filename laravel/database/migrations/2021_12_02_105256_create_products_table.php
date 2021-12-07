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
           // $table->foreignId('users_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('product_name')->unique();
            //$table->foreignId('categories_name')->constrained('categories');
            $table->text('description')->nullable();
            $table->integer('price');
            $table->integer('quantity')->default(1);
            $table->date('first_discount');
            $table->date('second_discount');
            $table->date('third_discount');
            $table->date('expired_date');
            $table->integer('first_price');
            $table->integer('second_price');
            $table->integer('third_price');
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
