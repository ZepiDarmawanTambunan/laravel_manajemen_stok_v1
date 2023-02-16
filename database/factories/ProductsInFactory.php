<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use phpDocumentor\Reflection\Types\This;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductsIn>
 */
class ProductsInFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'merk_barang' => $this->faker->unique()->word(),
            'jumlah_barang' => $this->faker->numberBetween(12, 41),
            'harga_satuan' => $this->faker->numberBetween(2000, 20000),
            'ukuran' => $this->faker->numberBetween(100, 10000),
            'tanggal_masuk' => $this->faker->dateTimeThisMonth(),
            'expired' => $this->faker->dateTimeThisMonth(),
        ];
    }
}
