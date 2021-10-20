<?php

namespace Database\Factories;

use App\Models\TipoMedicamento;
use Illuminate\Database\Eloquent\Factories\Factory;

class TipoMedicamentoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TipoMedicamento::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->unique()->randomElements(['Pastilla', 'Solución', 'Inyección', 'Polvo', 'Gotas', 'Inhalador', 'Otro']),
            'medida' => $this->faker->randomElements(['g', 'IU', 'mcg', 'mEq', 'mg']),
            'created_at'=>now(),
            'updated_at'=>now(),
        ];
    }
}
