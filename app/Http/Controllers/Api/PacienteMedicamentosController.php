<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Models\PacienteMedicamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class PacienteMedicamentosController extends Controller
{

    /**
     * Display a listing of the assets.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $pacienteMedicamentos = PacienteMedicamento::with('paciente','medicamento')->paginate(25);

        $data = $pacienteMedicamentos->transform(function ($pacienteMedicamento) {
            return $this->transform($pacienteMedicamento);
        });

        return $this->successResponse(
            'Paciente Medicamentos were successfully retrieved.',
            $data,
            [
                'links' => [
                    'first' => $pacienteMedicamentos->url(1),
                    'last' => $pacienteMedicamentos->url($pacienteMedicamentos->lastPage()),
                    'prev' => $pacienteMedicamentos->previousPageUrl(),
                    'next' => $pacienteMedicamentos->nextPageUrl(),
                ],
                'meta' =>
                [
                    'current_page' => $pacienteMedicamentos->currentPage(),
                    'from' => $pacienteMedicamentos->firstItem(),
                    'last_page' => $pacienteMedicamentos->lastPage(),
                    'path' => $pacienteMedicamentos->resolveCurrentPath(),
                    'per_page' => $pacienteMedicamentos->perPage(),
                    'to' => $pacienteMedicamentos->lastItem(),
                    'total' => $pacienteMedicamentos->total(),
                ],
            ]
        );
    }

    /**
     * Store a new paciente medicamento in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = $this->getValidator($request);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors()->all());
            }

            $data = $this->getData($request);
            
            $pacienteMedicamento = PacienteMedicamento::create($data);

            return $this->successResponse(
			    'Paciente Medicamento was successfully added.',
			    $this->transform($pacienteMedicamento)
			);
        } catch (Exception $exception) {
            return $this->errorResponse('Unexpected error occurred while trying to process your request.');
        }
    }

    /**
     * Display the specified paciente medicamento.
     *
     * @param int $id
     *
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $pacienteMedicamento = PacienteMedicamento::with('paciente','medicamento')->findOrFail($id);

        return $this->successResponse(
		    'Paciente Medicamento was successfully retrieved.',
		    $this->transform($pacienteMedicamento)
		);
    }

    /**
     * Update the specified paciente medicamento in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        try {
            $validator = $this->getValidator($request);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors()->all());
            }

            $data = $this->getData($request);
            
            $pacienteMedicamento = PacienteMedicamento::findOrFail($id);
            $pacienteMedicamento->update($data);

            return $this->successResponse(
			    'Paciente Medicamento was successfully updated.',
			    $this->transform($pacienteMedicamento)
			);
        } catch (Exception $exception) {
            return $this->errorResponse('Unexpected error occurred while trying to process your request.');
        }
    }

    /**
     * Remove the specified paciente medicamento from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $pacienteMedicamento = PacienteMedicamento::findOrFail($id);
            $pacienteMedicamento->delete();

            return $this->successResponse(
			    'Paciente Medicamento was successfully deleted.',
			    $this->transform($pacienteMedicamento)
			);
        } catch (Exception $exception) {
            return $this->errorResponse('Unexpected error occurred while trying to process your request.');
        }
    }
    
    /**
     * Gets a new validator instance with the defined rules.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Support\Facades\Validator
     */
    protected function getValidator(Request $request)
    {
        $rules = [
            'fecha' => 'required|string|min:1',
            'hora' => 'required|date_format:j/n/Y g:i A',
            'tipo' => 'required',
            'frecuencia' => 'required|string|min:1|max:255',
            'horario' => 'required|string|min:1|max:255',
            'total_medicamentos' => 'required|numeric|min:-2147483648|max:2147483647',
            'ultima_fecha' => 'nullable|date_format:j/n/Y g:i A',
            'estado' => 'boolean',
            'paciente_id' => 'required',
            'medicamento_id' => 'required', 
        ];

        return Validator::make($request->all(), $rules);
    }

    
    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request 
     * @return array
     */
    protected function getData(Request $request)
    {
        $rules = [
                'fecha' => 'required|string|min:1',
            'hora' => 'required|date_format:j/n/Y g:i A',
            'tipo' => 'required',
            'frecuencia' => 'required|string|min:1|max:255',
            'horario' => 'required|string|min:1|max:255',
            'total_medicamentos' => 'required|numeric|min:-2147483648|max:2147483647',
            'ultima_fecha' => 'nullable|date_format:j/n/Y g:i A',
            'estado' => 'boolean',
            'paciente_id' => 'required',
            'medicamento_id' => 'required', 
        ];

        
        $data = $request->validate($rules);


        $data['estado'] = $request->has('estado');


        return $data;
    }

    /**
     * Transform the giving paciente medicamento to public friendly array
     *
     * @param App\Models\PacienteMedicamento $pacienteMedicamento
     *
     * @return array
     */
    protected function transform(PacienteMedicamento $pacienteMedicamento)
    {
        return [
            'id' => $pacienteMedicamento->id,
            'fecha' => $pacienteMedicamento->fecha,
            'hora' => $pacienteMedicamento->hora,
            'tipo' => $pacienteMedicamento->tipo,
            'frecuencia' => $pacienteMedicamento->frecuencia,
            'horario' => $pacienteMedicamento->horario,
            'total_medicamentos' => $pacienteMedicamento->total_medicamentos,
            'ultima_fecha' => $pacienteMedicamento->ultima_fecha,
            'estado' => ($pacienteMedicamento->estado) ? 'Yes' : 'No',
            'paciente_id' => optional($pacienteMedicamento->Paciente)->nombres,
            'medicamento_id' => optional($pacienteMedicamento->Medicamento)->nombre,
        ];
    }


}
