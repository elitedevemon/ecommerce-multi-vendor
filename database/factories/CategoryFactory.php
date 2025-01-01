<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {

    return [
      //'title', 'slug', 'photo', 'parent_id', 'summary', 'is_parent', 'status'
      "title" => $this->faker->sentence,
      "slug" => $this->faker->slug,
      "parent_id" => $this->faker->randomElement(Category::pluck("id")->toArray()),
      "summary" => $this->faker->text(300),
      "is_parent" => $this->faker->randomElement([true, false]),
      'status' => $this->faker->randomElement(['active', 'inactive'])
    ];
  }
}