<?php

namespace App\Repositories\V1;

use Illuminate\Support\Facades\Auth;
use App\Models\V1\Customer;

class CustomerRepository
{
    public function get($request)
    {
        $query = Customer::orderBy('id', 'desc');
        if (isset($request->name)) {
            if ($request->name != null) {
                $query = $query->where('name', 'LIKE', "%{$request->name}%");
            }
        }

        if (isset($request->email)) {
            if ($request->email != null) {
                $query = $query->where('email', 'LIKE', "%{$request->email}%");
            }
        }

        if (isset($request->mobile)) {
            if ($request->mobile != null) {
                $query = $query->where('mobile', 'LIKE', "%{$request->mobile}%");
            }
        }

        if (isset($request->address)) {
            if ($request->address != null) {
                $query = $query->where('address', 'LIKE', "%{$request->address}%");
            }
        }
        

        return $query->paginate(10);
    }

    public function create($input)
    {
        $input['created_by'] = auth()->user()->id;
        return Customer::create($input);
    }

    public function find($id)
    {
        return Customer::find($id);
    }

    public function update($customer, $request)
    {
        $customer->update($request);
        return $customer;
    }

    public function destroy($customer)
    {
        $user = Auth::user();
        if ($user->hasRole('owner')) {
            $customer->forceDelete();
        } else if($user->hasRole('manager')) {
            $customer->delete();   
        }
        return;
    }
}
 