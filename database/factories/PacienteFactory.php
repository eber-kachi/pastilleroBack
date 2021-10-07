<?php

namespace Database\Factories;

use App\Models\Paciente;
use Illuminate\Database\Eloquent\Factories\Factory;

class PacienteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Paciente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "nombres" => $this->faker->name(),
            "apellidos" => $this->faker->monthName(),
            "fecha_nacimiento" => $this->faker->date(),
            "direccion" => $this->faker->address(),
            "celular" => $this->faker->randomNumber(7),

        ];
    }
}
