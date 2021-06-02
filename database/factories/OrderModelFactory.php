<?php

namespace Database\Factories;

use App\Models\OrderModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber,
            'product_id' => $this->faker->numberBetween(1,50)
        ];
    }
}
