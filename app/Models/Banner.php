<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Banner extends Model
{
  protected $fillable = ['title', 'slug', 'url', 'description', 'photo', 'status', 'condition'];

  // protected function prepareForValidation()
  // {
  //   $this->merge([
  //     'slug' => $this->title
  //   ]);
  // }

  // protected static function booted(): void
  // {
  //   static::creating(function ($banner) {
  //     $banner->slug = Str::slug($banner->title);
  //   });
  // }
}