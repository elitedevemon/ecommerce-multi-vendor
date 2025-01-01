<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Number;
use Illuminate\Support\Str;

class Product extends Model
{
  /** @use HasFactory<\Database\Factories\ProductFactory> */
  use HasFactory;

  /**
   * fillable
   *
   * @var array
   */
  protected $fillable = [
    'title',
    'slug',
    'summary',
    'description',
    'stock',
    'brand_id',
    'category_id',
    'child_category_id',
    'photo',
    'price',
    'offer_price',
    'discount',
    'size',
    'condition',
    'vendor_id',
    'status'
  ];

  public function getPriceAttribute($value)
  {
    return Number::currency($value);
  }

  public function getOfferPriceAttribute($value)
  {
    if ($value) {
      return Number::currency($value);
    }
  }

  public function getDiscountAttribute($value)
  {
    $value = (float) $value;
    return Number::percentage($value);
  }

  public function getSizeAttribute($value)
  {
    return Str::upper($value);
  }

  // Empty the dynamic accessors appends property
  public function disableDynamicAccessors()
  {
    $this->appends = [];
  }

  public function vendor(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  public function brand(): BelongsTo
  {
    return $this->belongsTo(Brand::class);
  }

  public function category(): BelongsTo
  {
    return $this->belongsTo(Category::class);
  }

  public function childCategory(): BelongsTo
  {
    return $this->belongsTo(Category::class, 'child_category_id', 'id');
  }

  public function related_products()
  {
    return $this->hasMany(Product::class, 'category_id', 'category_id')->where('status', 'active')->orderByDesc('id')->limit(10);
  }
}