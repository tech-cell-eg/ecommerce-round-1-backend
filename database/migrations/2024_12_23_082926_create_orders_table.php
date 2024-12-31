<?php

use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserCard;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(UserAddress::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(UserCard::class)->nullable()->constrained()->cascadeOnDelete();
            $table->enum('payment_method', ['cash', 'paypal', 'card', 'google_pay'])->default('cash');
            $table->enum('status', ['delivered', 'in process', 'cancelled'])->default('in process');
            $table->string('delivery_date')->default(date('d-M-Y', strtotime('+2 day')));
            $table->string('discount_code')->nullable();
            $table->decimal('delivery_charge')->default(0);
            $table->decimal('grand_total')->default(0);
            $table->string('review')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
