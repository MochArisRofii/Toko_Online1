<?php

namespace Modules\Shop\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Shop\Models\ProductImage;

class ProductImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = ProductImage::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [];
    }
}

