<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      //title, slug, photo, status
      "title" => $this->faker->sentence(3),
      "slug" => $this->faker->slug(),
      "photo" => $this->faker->imageUrl(),
      "status" => $this->faker->randomElement(["active", "inactive"]),
    ];
  }
}