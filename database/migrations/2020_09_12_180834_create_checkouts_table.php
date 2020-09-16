<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('payment')->default(0);
            $table->integer('count')->unsigned()->default(0);
            $table->string('price')->nullable();
            $table->string('resnumber')->nullable();

            $table->text('address')->nullable();
            $table->string('name')->nullable();
            $table->string('lastName')->nullable();
            $table->string('phone',11)->nullable();
            $table->string('postCode')->nullable();
            $table->boolean('deliver')->default(0);

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
        Schema::dropIfExists('checkouts');
    }
}
