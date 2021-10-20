<?php

namespace Database\Seeders;

use App\Models\TipoMedicamento;
use Illuminate\Database\Seeder;

class TipoMedicamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoMedicamento::factory(7)->create();
    }
}
