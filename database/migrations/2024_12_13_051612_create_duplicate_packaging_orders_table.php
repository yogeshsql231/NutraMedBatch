<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('duplicate_packaging_orders', function (Blueprint $table) {
            $table->id();

            $table->integer('orderId')->required();
            $table->date('orderDate')->nullable();

            $table->unsignedBigInteger('customerId')->nullable();
            $table->foreign('customerId')->references('id')->on('customers')->onDelete('cascade');

            $table->string('productName')->nullable();
            $table->string('genericName')->nullable();
            $table->string('PO')->nullable();
            $table->string('fProduct')->required();
            $table->string('formula')->required();
            $table->string('WO')->required();
            $table->string('LOT')->required();
            $table->string('Exp')->nullable();
            $table->integer('orderQty')->nullable();
            $table->integer('poQty')->nullable();
            $table->string('dosageForm')->nullable();
            $table->string('ofDosesUnit')->required();
            $table->string('bluckProdLot')->required();
            $table->string('prodSuplyBy')->nullable();
            $table->string('ndcUpc')->required();
            $table->text('unitDescription')->nullable();
            $table->text('customerInfo')->nullable();
            $table->json('compName')->nullable();
            $table->json('compDesc')->nullable();
            $table->json('compCode')->nullable();
            $table->text('packInstruction')->nullable();
            $table->string('toolingNumber')->nullable();
            $table->string('toolingDrawing')->nullable();
            $table->text('testToolingSpecfication')->nullable();
            $table->string('pkgSize')->nullable();
            $table->string('matWidth')->nullable();
            $table->string('foilYield')->nullable();
            $table->string('foilcode')->nullable();
            $table->string('PvcYield')->nullable();
            $table->string('PbvCode')->nullable();
            $table->text('visualInspection')->nullable();
            $table->string('testOne')->nullable();
            $table->string('testTwo')->nullable();
            $table->string('testThree')->nullable();
            $table->string('testFour')->nullable();
            $table->string('testFive')->nullable();
            $table->text('processParameter')->nullable();
            $table->text('peopleAssigment')->nullable();
            $table->text('inspectionInst')->nullable();
            $table->string('document')->required();
            $table->string('masterOrd')->required();
            $table->string('newOrderCreatedBy')->nullable();
            $table->json('indexSetting')->nullable();
            $table->json('testSerial')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('duplicate_packaging_orders');
    }
};
