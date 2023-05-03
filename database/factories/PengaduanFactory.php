<?php

namespace Database\Factories;

use App\Models\Pengaduan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pengaduan>
 */
class PengaduanFactory extends Factory
{
    protected $model = Pengaduan::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'subject' => $this->faker->sentence(),
            'message' => $this->faker->paragraph()
        ];
    }
}
