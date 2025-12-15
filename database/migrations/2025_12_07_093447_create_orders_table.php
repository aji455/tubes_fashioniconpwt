<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Data customer
            $table->string('full_name');
            $table->string('phone');
            $table->string('email');
            $table->string('address');
            $table->string('city');
            $table->string('province');
            $table->string('postal_code');
            $table->string('notes')->nullable();

            // Shipping cost relation
            $table->foreignId('shipping_costs_id')->constrained()->onDelete('cascade');

            // Total
            $table->integer('subtotal');
            $table->integer('shipping_price');
            $table->integer('total');

            // Status pengiriman dan pesanan
            $table->enum('shipping_status', ['pending', 'packed', 'shipped', 'delivered'])
                ->default('pending');
            $table->enum('status', ['pending', 'process', 'completed'])->default('pending');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
