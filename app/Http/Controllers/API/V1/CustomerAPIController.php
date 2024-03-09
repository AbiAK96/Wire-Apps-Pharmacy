<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\AppBaseController;
use App\Repositories\V1\CustomerRepository;
use Illuminate\Http\Request;
use App\Http\Requests\API\CustomerRequest;

class CustomerAPIController extends AppBaseController
{
    private $customerRepository;

    public function __construct(CustomerRepository $customerRepo)
    {
        $this->customerRepository = $customerRepo;
    }

    public function index(Request $request)
    {
        try {
            $customers = $this->customerRepository->get($request);
            return $this->successResponse($customers, 'Customers retrieved successfully');
        } catch (\Throwable $th) {
            return $this->errorResponse('Something went wrong !.', 401);
        }
    }

    public function store(CustomerRequest $request)
    {
        try {
            if(auth()->user()->hasRole('owner')){
                $customer = $this->customerRepository->create($request->all());
                return $this->successResponse($customer, 'Inserted Successfully.');
            }
            return $this->errorResponse('Unauthorized Access !.', 401);
        } catch (\Throwable $th) {
            return $this->errorResponse('Something went wrong !.', 401);
        }
    }

    public function update($id, CustomerRequest $request)
    {
        try {
            $customer = $this->customerRepository->find($id);
            if ($customer) {
                $customers = $this->customerRepository->update($medication, $request->all());
                return $this->successResponse($customers, 'Updated Successfully.');
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
                $customer = $this->customerRepository->find($id);
                if ($customer) {
                    $this->customerRepository->destroy($customer);
                    return $this->successResponse(null, 'Deleted Successfully.');
                }
                return $this->errorResponse('Customer not found!.', 404);
            }
            return $this->errorResponse('Unauthorized Access !.', 401);
        } catch (\Throwable $th) {
            return $this->errorResponse('Something went wrong !.', 401);
        }
    }
}