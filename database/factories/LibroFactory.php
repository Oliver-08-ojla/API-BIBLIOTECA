<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Libro>
 */
class LibroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
           'titulo'=>$this->faker->unique()->word(2),
           'autor'=>$this->faker->word(),
            'url_libro'=>$this->faker->imageUrl(640, 480, 'animals', true),
           'estado'=>true,
            'image_id'=>$this->faker->numberBetween(1,100)



        ];
    }
}
