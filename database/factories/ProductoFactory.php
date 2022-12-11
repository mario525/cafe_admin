<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'categoria_id' => rand(1,3),
            'nombre' => $this->faker->name(),
            'descripcion' =>$this->faker->sentence(),
            'precio' => rand(1,50),
            'imagen' => "storage/upload/producto/202211190223_producto_cafe2.jpg",
            'estatus' => 'ACTIVO',
            'created_by' => 'SEEDER',
            'updated_by' => 'SEEDER',
            'created_at' => Carbon::now()->setTimezone('America/Mexico_City'),
            'updated_at' => Carbon::now()->setTimezone('America/Mexico_City'),
        ];
    }
}
