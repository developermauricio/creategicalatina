<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialPurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_purchase')->unsigned()->nullable();
            $table->foreign('id_purchase')->references('id')->on('purchase_orders');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->text('class_color')->nullable();
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
        Schema::dropIfExists('historial_purchase_orders');
    }
}
