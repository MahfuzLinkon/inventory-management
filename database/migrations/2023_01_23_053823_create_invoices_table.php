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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('invoice_no');
            $table->date('date');
            $table->text('description')->nullable();
            $table->integer('grand_total')->nullable();
            $table->tinyInteger('status')->default(0)->comment('1=>approved; 0=>Pending');
            $table->tinyInteger('created_by')->nullable();
            $table->tinyInteger('approve_by')->nullable();
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
};
