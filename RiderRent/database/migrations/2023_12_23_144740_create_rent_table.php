<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use app\Models\User;
use app\Models\Moto;
use app\Models\Discount;

return new class extends Migration {
    public function up(): void {
        if (!Schema::hasTable('rents')) {
            Schema::create('rents', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
                $table->foreignId('moto_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
                $table->foreignId('discount_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
                $table->dateTimeTz('start_date');
                $table->dateTimeTz('requested_end_date');
                $table->dateTimeTz('actual_end_date')->nullable();
                $table->decimal('total_requested_price', 8, 2);
                $table->decimal('total_actual_price', 8, 2);
                $table->boolean('is_active');
                $table->timestamps();
            });
        }
    }
    
    public function down(): void {
        Schema::dropIfExists('rents');
    }
};
