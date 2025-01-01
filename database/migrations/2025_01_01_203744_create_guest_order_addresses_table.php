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
    Schema::create('guest_order_addresses', function (Blueprint $table) {
      $table->id();
      $table->primary('guest_id');
      //shipping
      $table->string('s_recipient')->nullable();
      $table->string('s_phone')->nullable();
      $table->string('s_email')->nullable();
      $table->string('s_country')->nullable();
      $table->string('s_street_address')->nullable();
      $table->string('s_apartment')->nullable()->nullable();
      $table->string('s_city')->nullable();
      $table->string('s_state')->nullable();
      $table->string('s_post_code')->nullable();
      $table->text('s_notes')->nullable()->nullable();
      $table->string('s_delivery_address')->nullable();
      //billing
      $table->string('b_recipient')->nullable();
      $table->string('b_phone')->nullable();
      $table->string('b_email')->nullable();
      $table->string('b_country')->nullable();
      $table->string('b_street_address')->nullable();
      $table->string('b_apartment')->nullable();
      $table->string('b_city')->nullable();
      $table->string('b_state')->nullable();
      $table->string('b_post_code')->nullable();
      $table->text('b_notes')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('guest_order_addresses');
  }
};