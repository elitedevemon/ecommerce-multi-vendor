<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    // code, type, value, status
    Schema::create('coupons', function (Blueprint $table) {
      $table->id();
      $table->string('code')->unique();
      $table->enum('type', ['fixed', 'percent'])->default('fixed');
      $table->integer('value');
      $table->enum('status', ['active', 'inactive'])->default('active');
      $table->date('expiry_date');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('coupons');
  }
};