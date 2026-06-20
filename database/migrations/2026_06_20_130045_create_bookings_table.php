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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
        
            // relasi destinasi
            $table->foreignId('destination_id')
            ->references('id')
            ->on('travel_items')
            ->cascadeOnDelete();
        
            // informasi pemesan
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
        
            // detail perjalanan
            $table->date('departure_date');
            $table->integer('quantity')->default(1);
            $table->text('address');
            $table->string('country');
        
            // pembayaran
            $table->string('card_name');
            $table->string('card_number');
            $table->string('card_expiry');
            $table->string('card_cvv');
        
            // harga
            $table->decimal('total_price', 15, 2);
        
            // status
            $table->enum('status', [
                'pending',
                'paid',
                'cancelled'
            ])->default('pending');
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
