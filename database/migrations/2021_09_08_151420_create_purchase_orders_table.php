<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects');
            $table->unsignedBigInteger('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->unsignedBigInteger('company_id')->unsigned()->nullable();
            $table->foreign('company_id')->references('id')->on('companies');
            $table->unsignedBigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('payment_type_id')->unsigned()->nullable();
            $table->foreign('payment_type_id')->references('id')->on('payment_platforms');
            $table->string('code')->nullable();
            $table->text('note')->nullable();
            $table->double('subtotal')->nullable();
            $table->double('total')->nullable();
            $table->double('iva')->nullable();
            $table->string('slug')->nullable();
            $table->enum('state', [
                \App\Model\PurchaseOrder::PENDING_PAY,
                \App\Model\PurchaseOrder::BORRADOR,
                \App\Model\PurchaseOrder::PAID,
                \App\Model\PurchaseOrder::REJECTED,
            ])->default( \App\Model\Invoice::BORRADOR);
            $table->enum('way_to_pay', [
               \App\Model\PurchaseOrder::MANUAL,
               \App\Model\PurchaseOrder::ONLINE,
               \App\Model\PurchaseOrder::PENDING,
            ])->default(\App\Model\PurchaseOrder::PENDING);
            $table->date('date')->nullable();
            $table->date('end_date')->nullable();
            $table->date('expiration')->nullable();
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
        Schema::dropIfExists('purchase_orders');
    }
}
