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
    // user_id, recipient, phone, email, country, street_address, apartment, city, state, post_code, notes
    Schema::create('billing_addresses', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
      $table->string('recipient')->nullable();
      $table->string('phone')->nullable();
      $table->string('email')->nullable();
      $table->string('country')->nullable();
      $table->string('street_address')->nullable();
      $table->string('apartment')->nullable();
      $table->string('city')->nullable();
      $table->string('state')->nullable();
      $table->string('post_code')->nullable();
      $table->text('notes')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('billing_addresses');
  }
};