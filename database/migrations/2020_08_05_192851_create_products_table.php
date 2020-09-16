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

            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade')->onUpdate('cascade');

            $table->string('title');
            $table->text('image');
            $table->string('slug');
            $table->string('brand');
            $table->text('body');
            $table->text('color')->nullable();
            $table->text('size')->nullable();
            $table->string('price');
            $table->string('discount')->default(0);
            $table->string('count')->default(0);
            $table->integer('rate')->default(0);
            $table->boolean('status')->default(0);
            $table->boolean('top_offer')->default(false);
            $table->integer('sell_count')->unsigned()->default(0);
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
