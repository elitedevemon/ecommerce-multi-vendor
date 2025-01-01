<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      //title, slug, summary, description, stock, brand_id, category_id, child_category_id, photo, price, offer_price, discount, size, condition, vendor_id, status
      "title" => $this->faker->sentence,
      "slug" => $this->faker->slug,
      "summary" => $this->faker->sentence(3),
      "description" => $this->faker->sentence(5),
      "stock" => $this->faker->numberBetween(2, 10),
      'brand_id' => $this->faker->randomElement(Brand::pluck('id')->toArray()),
      'category_id' => $this->faker->randomElement(Category::where('is_parent', 1)->pluck('id')->toArray()),
      'child_category_id' => $this->faker->randomElement(Category::where('is_parent', 0)->pluck('id')->toArray()),
      'price' => $this->faker->numberBetween(100, 10000),
      'offer_price' => $this->faker->numberBetween(100, 1000),
      'discount' => $this->faker->numberBetween(0, 100),
      'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL']),
      'condition' => $this->faker->randomElement(['new', 'popular', 'winter']),
      'vendor_id' => $this->faker->randomElement(User::pluck('id')->toArray()),
      'status' => $this->faker->randomElement(['active', 'inactive'])
    ];
  }
}