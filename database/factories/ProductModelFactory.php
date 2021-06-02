<?php

namespace Database\Factories;

use App\Models\ProductModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->realText(30),
            'description' => $this->faker->realText(),
            'price' => $this->faker->randomNumber(5),
            'old_price' => null,
            'amount' => $this->faker->numberBetween(1, 1000),
            'brand' => collect(['samsung', 'apple', 'microsoft', 'xiaomi'])->random(),
            'photos' => collect([$this->faker->imageUrl(), $this->faker->imageUrl(), $this->faker->imageUrl(), $this->faker->imageUrl(), $this->faker->imageUrl()])->toJson(),
            'liquid' => $this->faker->boolean(),
            'hard' => $this->faker->boolean(),
            'wet' => $this->faker->boolean(),
            'warm' => $this->faker->boolean(),
        ];
    }
}
