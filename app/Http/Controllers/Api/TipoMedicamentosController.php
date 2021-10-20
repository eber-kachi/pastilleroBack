<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Models\TipoMedicamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class TipoMedicamentosController extends Controller
{

    /**
     * Display a listing of the assets.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $tipoMedicamentos = TipoMedicamento::paginate(25);

        $data = $tipoMedicamentos->transform(function ($tipoMedicamento) {
            return $this->transform($tipoMedicamento);
        });

        return $this->successResponse(
            'Tipo Medicamentos were successfully retrieved.',
            $data,
            [
                'links' => [
                    'first' => $tipoMedicamentos->url(1),
                    'last' => $tipoMedicamentos->url($tipoMedicamentos->lastPage()),
                    'prev' => $tipoMedicamentos->previousPageUrl(),
                    'next' => $tipoMedicamentos->nextPageUrl(),
                ],
                'meta' =>
                [
                    'current_page' => $tipoMedicamentos->currentPage(),
                    'from' => $tipoMedicamentos->firstItem(),
                    'last_page' => $tipoMedicamentos->lastPage(),
                    'path' => $tipoMedicamentos->resolveCurrentPath(),
                    'per_page' => $tipoMedicamentos->perPage(),
                    'to' => $tipoMedicamentos->lastItem(),
                    'total' => $tipoMedicamentos->total(),
                ],
            ]
        );
    }

    /**
     * Store a new tipo medicamento in the storage.
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
            
            $tipoMedicamento = TipoMedicamento::create($data);

            return $this->successResponse(
			    'Tipo Medicamento was successfully added.',
			    $this->transform($tipoMedicamento)
			);
        } catch (Exception $exception) {
            return $this->errorResponse('Unexpected error occurred while trying to process your request.');
        }
    }

    /**
     * Display the specified tipo medicamento.
     *
     * @param int $id
     *
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoMedicamento = TipoMedicamento::findOrFail($id);

        return $this->successResponse(
		    'Tipo Medicamento was successfully retrieved.',
		    $this->transform($tipoMedicamento)
		);
    }

    /**
     * Update the specified tipo medicamento in the storage.
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
            
            $tipoMedicamento = TipoMedicamento::findOrFail($id);
            $tipoMedicamento->update($data);

            return $this->successResponse(
			    'Tipo Medicamento was successfully updated.',
			    $this->transform($tipoMedicamento)
			);
        } catch (Exception $exception) {
            return $this->errorResponse('Unexpected error occurred while trying to process your request.');
        }
    }

    /**
     * Remove the specified tipo medicamento from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $tipoMedicamento = TipoMedicamento::findOrFail($id);
            $tipoMedicamento->delete();

            return $this->successResponse(
			    'Tipo Medicamento was successfully deleted.',
			    $this->transform($tipoMedicamento)
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
            'nombre' => 'required|string|min:1|max:255',
            'medida' => 'required|string|min:1|max:255', 
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
                'nombre' => 'required|string|min:1|max:255',
            'medida' => 'required|string|min:1|max:255', 
        ];

        
        $data = $request->validate($rules);




        return $data;
    }

    /**
     * Transform the giving tipo medicamento to public friendly array
     *
     * @param App\Models\TipoMedicamento $tipoMedicamento
     *
     * @return array
     */
    protected function transform(TipoMedicamento $tipoMedicamento)
    {
        return [
            'id' => $tipoMedicamento->id,
            'nombre' => $tipoMedicamento->nombre,
            'medida' => $tipoMedicamento->medida,
        ];
    }


}
