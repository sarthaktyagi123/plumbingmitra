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
        Schema::create('product_listaas', function (Blueprint $table) {
            $table->string('Item_Details');
            $table->integer('MRP');
            $table->string('Parent_Group');
            $table->double('Qty');
            $table->integer('unit');
            $table->integer('price');
            $table->integer('quant');
            $table->string('unit1')->nullable();
            $table->double('price1')->nullable();
            $table->double('Amount')->nullable();
            $table->string('Disc-A')->nullable();
            $table->string('Disc-B')->nullable();
            $table->string('Disc-C')->nullable();
            $table->string('Disc-D')->nullable();
            $table->string('Disc-E')->nullable();
            $table->string('Disc-F')->nullable();
            $table->string('Disc-G')->nullable();
            $table->string('Disc-H')->nullable();
            $table->string('Disc-J')->nullable();
            $table->string('Disc-K')->nullable();
            $table->string('Disc-L')->nullable();
            $table->string('Disc-M')->nullable();
            $table->string('Disc-N')->nullable();
            $table->string('Disc-O')->nullable();
            $table->id();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_listaas');
    }
};
