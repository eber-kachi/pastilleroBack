<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PacienteMedicamento extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'paciente_medicamentos';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'fecha',
                  'hora',
                  'tipo',
                  'frecuencia',
                  'horario',
                  'total_medicamentos',
                  'ultima_fecha',
                  'estado',
                  'paciente_id',
                  'medicamento_id'
              ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
    
    /**
     * Get the Paciente for this model.
     *
     * @return App\Models\Paciente
     */
    public function Paciente()
    {
        return $this->belongsTo('App\Models\Paciente','paciente_id','id');
    }

    /**
     * Get the Medicamento for this model.
     *
     * @return App\Models\Medicamento
     */
    public function Medicamento()
    {
        return $this->belongsTo('App\Models\Medicamento','medicamento_id','id');
    }

    /**
     * Set the hora.
     *
     * @param  string  $value
     * @return void
     */
    public function setHoraAttribute($value)
    {
        $this->attributes['hora'] = !empty($value) ? \DateTime::createFromFormat('[% date_format %]', $value) : null;
    }

    /**
     * Set the ultima_fecha.
     *
     * @param  string  $value
     * @return void
     */
    public function setUltimaFechaAttribute($value)
    {
        $this->attributes['ultima_fecha'] = !empty($value) ? \DateTime::createFromFormat('[% date_format %]', $value) : null;
    }

    /**
     * Get hora in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getHoraAttribute($value)
    {
        return \DateTime::createFromFormat($this->getDateFormat(), $value)->format('j/n/Y g:i A');
    }

    /**
     * Get ultima_fecha in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getUltimaFechaAttribute($value)
    {
        return \DateTime::createFromFormat($this->getDateFormat(), $value)->format('j/n/Y g:i A');
    }

    /**
     * Get created_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getCreatedAtAttribute($value)
    {
        return \DateTime::createFromFormat($this->getDateFormat(), $value)->format('j/n/Y g:i A');
    }

    /**
     * Get updated_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getUpdatedAtAttribute($value)
    {
        return \DateTime::createFromFormat($this->getDateFormat(), $value)->format('j/n/Y g:i A');
    }

}
