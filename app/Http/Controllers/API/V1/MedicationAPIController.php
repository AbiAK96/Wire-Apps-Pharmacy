<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\AppBaseController;
use App\Repositories\V1\MedicationRepository;
use Illuminate\Http\Request;
use App\Http\Requests\API\MedicationRequest;

class MedicationAPIController extends AppBaseController
{
    private $medicationRepository;

    public function __construct(MedicationRepository $medicationRepo)
    {
        $this->medicationRepository = $medicationRepo;
    }

    public function index(Request $request)
    {
        try {
            $medications = $this->medicationRepository->get($request);
            return $this->successResponse($medications, 'Medications retrieved successfully');
        } catch (\Throwable $th) {
            return $this->errorResponse('Something went wrong !.', 401);
        }
    }

    public function store(MedicationRequest $request)
    {
        try {
            if(auth()->user()->hasRole('owner')){
                $medications = $this->medicationRepository->create($request->all());
                return $this->successResponse($medications, 'Inserted Successfully.');
            }
            return $this->errorResponse('Unauthorized Access !.', 401);
        } catch (\Throwable $th) {
            return $this->errorResponse('Something went wrong !.', 401);
        }
    }

    public function update($id, MedicationRequest $request)
    {
        try {
            $medication = $this->medicationRepository->find($id);
            if ($medication) {
                $medications = $this->medicationRepository->update($medication, $request->all());
                return $this->successResponse($medications, 'Updated Successfully.');
            }
            return $this->errorResponse('Medication not found!.', 404);
        } catch (\Throwable $th) {
            return $this->errorResponse('Something went wrong !.', 401);
        }
    }

    public function destroy($id)
    {
        try {
            if((auth()->user()->hasRole('owner')) || (auth()->user()->hasRole('manager'))){
                $medication = $this->medicationRepository->find($id);
                if ($medication) {
                    $this->medicationRepository->destroy($medication);
                    return $this->successResponse(null, 'Deleted Successfully.');
                }
                return $this->errorResponse('Medication not found!.', 404);
            }
            return $this->errorResponse('Unauthorized Access !.', 401);
        } catch (\Throwable $th) {
            return $this->errorResponse('Something went wrong !.', 401);
        }
    }
}