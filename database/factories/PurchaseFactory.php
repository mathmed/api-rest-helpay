<?php

namespace Database\Factories;

use App\Models\Purchase;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PurchaseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Purchase::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $productId = Product::all()->random();

        return [
            'product_id' => $productId,
            'quantity_purchased' => $this->faker->numberBetween(1, 10),
        ];
    }
}
