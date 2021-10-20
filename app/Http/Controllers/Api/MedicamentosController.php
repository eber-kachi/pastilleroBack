<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Models\Medicamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class MedicamentosController extends Controller
{

    /**
     * Display a listing of the assets.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $medicamentos = Medicamento::with('tipomedicamento')->paginate(25);

        $data = $medicamentos->transform(function ($medicamento) {
            return $this->transform($medicamento);
        });

        return $this->successResponse(
            'Medicamentos were successfully retrieved.',
            $data,
            [
                'links' => [
                    'first' => $medicamentos->url(1),
                    'last' => $medicamentos->url($medicamentos->lastPage()),
                    'prev' => $medicamentos->previousPageUrl(),
                    'next' => $medicamentos->nextPageUrl(),
                ],
                'meta' =>
                [
                    'current_page' => $medicamentos->currentPage(),
                    'from' => $medicamentos->firstItem(),
                    'last_page' => $medicamentos->lastPage(),
                    'path' => $medicamentos->resolveCurrentPath(),
                    'per_page' => $medicamentos->perPage(),
                    'to' => $medicamentos->lastItem(),
                    'total' => $medicamentos->total(),
                ],
            ]
        );
    }

    /**
     * Store a new medicamento in the storage.
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
            
            $medicamento = Medicamento::create($data);

            return $this->successResponse(
			    'Medicamento was successfully added.',
			    $this->transform($medicamento)
			);
        } catch (Exception $exception) {
            return $this->errorResponse('Unexpected error occurred while trying to process your request.');
        }
    }

    /**
     * Display the specified medicamento.
     *
     * @param int $id
     *
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $medicamento = Medicamento::with('tipomedicamento')->findOrFail($id);

        return $this->successResponse(
		    'Medicamento was successfully retrieved.',
		    $this->transform($medicamento)
		);
    }

    /**
     * Update the specified medicamento in the storage.
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
            
            $medicamento = Medicamento::findOrFail($id);
            $medicamento->update($data);

            return $this->successResponse(
			    'Medicamento was successfully updated.',
			    $this->transform($medicamento)
			);
        } catch (Exception $exception) {
            return $this->errorResponse('Unexpected error occurred while trying to process your request.');
        }
    }

    /**
     * Remove the specified medicamento from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $medicamento = Medicamento::findOrFail($id);
            $medicamento->delete();

            return $this->successResponse(
			    'Medicamento was successfully deleted.',
			    $this->transform($medicamento)
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
            'tipo_medicamento_id' => 'required', 
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
            'tipo_medicamento_id' => 'required', 
        ];

        
        $data = $request->validate($rules);




        return $data;
    }

    /**
     * Transform the giving medicamento to public friendly array
     *
     * @param App\Models\Medicamento $medicamento
     *
     * @return array
     */
    protected function transform(Medicamento $medicamento)
    {
        return [
            'id' => $medicamento->id,
            'nombre' => $medicamento->nombre,
            'tipo_medicamento_id' => optional($medicamento->TipoMedicamento)->nombre,
        ];
    }


}
