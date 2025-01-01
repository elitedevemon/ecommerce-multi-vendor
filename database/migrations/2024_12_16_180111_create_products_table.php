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
    //title, slug, summary, description, stock, brand_id, category_id, child_category_id, photo, price, offer_price, discount, size, condition, vendor_id, status
    Schema::create('products', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->string('slug')->unique();
      $table->mediumText('summary')->nullable();
      $table->longText('description')->nullable();
      $table->integer('stock')->nullable();
      $table->foreignId('brand_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
      $table->foreignId('category_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
      $table->foreignId('child_category_id')->nullable()->constrained('categories', 'id')->onDelete('CASCADE')->onUpdate('CASCADE');
      $table->string('photo')->nullable();
      $table->float('price');
      $table->float('offer_price')->nullable();
      $table->float('discount')->nullable();
      $table->string('size')->nullable();
      $table->enum('condition', ['new', 'popular', 'winter'])->default('new');
      $table->foreignId('vendor_id')->constrained('users', 'id')->cascadeOnDelete()->cascadeOnUpdate();
      $table->enum('status', ['active', 'inactive'])->default('inactive');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('products');
  }
};