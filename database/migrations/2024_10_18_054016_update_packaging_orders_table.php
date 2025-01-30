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
        Schema::table('packaging_orders', function (Blueprint $table) {


            // $table->renameColumn('customerId', 'customer_id');
            $table->unsignedBigInteger('customerId')->nullable()->change();
            $table->foreign('customerId')->references('id')->on('customers')->onDelete('cascade');

            $table->string('PO')->nullable()->change();
            $table->string('Exp')->nullable()->change();

            $table->json('compName')->nullable()->change();
            $table->json('compDesc')->nullable()->change();
            $table->json('compCode')->nullable()->change();

            $table->text('testToolingSpecfication')->nullable()->change();
            $table->text('peopleAssigment')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('packaging_orders', function (Blueprint $table) {


            $table->dropForeign(['customer_id']);
            $table->renameColumn('customer_id', 'customerId');
            $table->string('customerId')->nullable()->change();

            $table->date('PO')->nullable(false)->change();
            $table->date('Exp')->nullable(false)->change();

            $table->string('compName')->nullable()->change();
            $table->string('compDesc')->nullable()->change();
            $table->string('compCode')->nullable()->change();

            $table->string('testToolingSpecfication')->nullable(false)->change();
            $table->string('peopleAssigment')->nullable(false)->change();
        });
    }
};
