<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects');
            $table->unsignedBigInteger('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->unsignedBigInteger('company_id')->unsigned()->nullable();
            $table->foreign('company_id')->references('id')->on('companies');
            $table->unsignedBigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('code')->nullable();
            $table->string('name')->nullable();
            $table->text('note')->nullable();
            $table->double('subtotal')->nullable();
            $table->double('total')->nullable();
            $table->double('iva')->nullable();
            $table->enum('state', [
                \App\Model\Invoice::REVISION,
                \App\Model\Invoice::BORRADOR,
                \App\Model\Invoice::APPROVED,
                \App\Model\Invoice::PAID,
                \App\Model\Invoice::REJECTED,
            ])->default(\App\Model\Project::BORRADOR);
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
        Schema::dropIfExists('invoices');
    }
}
