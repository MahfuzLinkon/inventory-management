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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('supplier_id');
            $table->bigInteger('category_id');
            $table->bigInteger('product_id');
            $table->string('purchase_no');
            $table->date('date');
            $table->text('description')->nullable();
            $table->double('quantity', 10, 2)->default(0);
            $table->double('unit_price', 10, 2)->default(0);
            $table->double('total_price', 10, 2)->default(0);
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
        Schema::dropIfExists('purchases');
    }
};
