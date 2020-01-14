<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealEstateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('real_estate', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('description')->nullable();
            $table->bigInteger('status_id')->unsigned();
            $table->bigInteger('operation_type_id')->unsigned();
            $table->unsignedDecimal('min_price', 14,2);
            $table->unsignedDecimal('max_price',14,2);
            $table->foreign('status_id')->references('id')->on('status');
            $table->foreign('operation_type_id')->references('id')->on('operation_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('real_estate');
    }
}
