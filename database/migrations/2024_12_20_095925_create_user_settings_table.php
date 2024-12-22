<?php

use App\Models\User;
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
        Schema::create('user_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->enum('appearance',['light','dark'])->default('light');
            $table->enum('language',['ar','en'])->default('en');
            $table->boolean('two_factor_authentication')->default(false);
            $table->boolean('push_notifications')->default(true);
            $table->boolean('desktop_notification')->default(true);
            $table->boolean('email_notifications')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_settings');
    }
};
