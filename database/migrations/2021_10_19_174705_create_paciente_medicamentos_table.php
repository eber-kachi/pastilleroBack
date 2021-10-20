<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacienteMedicamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paciente_medicamentos', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha');
            $table->time('hora');
            $table->enum('tipo', ['diario', 'horario']);
//            $table->string('tipo');
            $table->string('frecuencia'); //con que frecuencia se toma el medicamento
            $table->string('horario'); //con que horario toma el medicamento  mañana tarde noche medio dia
            $table->integer('total_medicamentos');
            $table->date('ultima_fecha')->nullable(); //opcional hasta cuando se toma la medicina
            $table->boolean('estado');

            $table->unsignedBigInteger('paciente_id');
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');

            $table->unsignedBigInteger('medicamento_id');
            $table->foreign('medicamento_id')->references('id')->on('medicamentos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paciente_medicamentos');
    }
}
