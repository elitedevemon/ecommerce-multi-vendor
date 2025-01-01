<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class Category extends Model
{
  /** @use HasFactory<\Database\Factories\CategoryFactory> */
  use HasFactory;

  protected $fillable = ['title', 'slug', 'photo', 'parent_id', 'summary', 'is_parent', 'status'];


  /**
   * Method parent
   *
   * @return BelongsTo
   */
  public function parent(): BelongsTo
  {
    return $this->belongsTo(Category::class, 'parent_id');
  }

  public function products()
  {
    return $this->hasMany(Product::class);
  }

}