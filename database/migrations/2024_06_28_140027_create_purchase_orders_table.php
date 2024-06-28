<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('supplier_id');
            $table->string('delivery_date');
            $table->unsignedBigInteger('site_id');
            $table->string('po_date');
            $table->string('contact_no');
            $table->string('reference');
            $table->string('terms');
            $table->string('due_date');
            $table->string('order_no');
            $table->string('tax_type');
            $table->string('subtotal');
            $table->string('total_with_tax');
            $table->string('delivery_instruction');
            $table->unsignedBigInteger('prepared_by');
            $table->unsignedBigInteger('reviewed_by');
            $table->unsignedBigInteger('approved_by');
            $table->unsignedBigInteger('received_by');
            $table->unsignedBigInteger('workstation_id');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('prepared_by')
                ->references('id')
                ->on('employees');

            $table->foreign('reviewed_by')
                ->references('id')
                ->on('employees');

            $table->foreign('approved_by')
                ->references('id')
                ->on('employees');

            $table->foreign('received_by')
                ->references('id')
                ->on('employees');

            $table->foreign('workstation_id')
                ->references('id')
                ->on('workstations');

            $table->foreign('created_by')
                ->references('id')
                ->on('users');

            $table->foreign('updated_by')
                ->references('id')
                ->on('users');
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
