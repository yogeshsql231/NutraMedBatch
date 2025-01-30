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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id')->unique();
            $table->string('customer_name');
            $table->string('contact_person');
            $table->string('phone');
            $table->string('address_street');
            $table->string('address_street_2')->nullable();
            $table->string('town');
            $table->string('state');
            $table->string('zipcode');
            $table->string('shipping_street');
            $table->string('shipping_street_2')->nullable();
            $table->string('shipping_town');
            $table->string('shipping_state');
            $table->string('shipping_zipcode');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
