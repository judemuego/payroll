<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEarningsTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('earnings_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->string('sequence_no');
            $table->unsignedBigInteger('earning_id');
            $table->string('rate')->nullable();
            $table->string('hours')->nullable();
            $table->string('total')->nullable();
            $table->string('status')->nullable();
            $table->unsignedBigInteger('workstation_id');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();
            
            $table->foreign('employee_id')
                ->references('id')
                ->on('employees');

            $table->foreign('earning_id')
                ->references('id')
                ->on('earnings');

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
        Schema::dropIfExists('earnings_transactions');
    }
}
