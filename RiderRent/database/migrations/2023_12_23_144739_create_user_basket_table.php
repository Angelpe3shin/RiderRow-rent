<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        if (!Schema::hasTable('user_basket')) {
            Schema::create('user_basket', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
                $table->foreignId('moto_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
                $table->integer('quantity');
                $table->enum('status', ['pendingTransaction', 'paymentFinished', 'removedWithoutFinish']);
                $table->timestamps();
            });
        }
    }
    
    public function down(): void {
        Schema::dropIfExists('user_basket');
    }
    
};
