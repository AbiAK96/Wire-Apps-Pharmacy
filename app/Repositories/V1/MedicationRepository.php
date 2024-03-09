<?php

namespace App\Repositories\V1;

use Illuminate\Support\Facades\Auth;
use App\Models\V1\Medication;

class MedicationRepository
{
    public function get($request)
    {
        $query = Medication::orderBy('id', 'desc');
        if (isset($request->name)) {
            if ($request->name != null) {
                $query = $query->where('name', 'LIKE', "%{$request->name}%");
            }
        }

        if (isset($request->code)) {
            if ($request->code != null) {
                $query = $query->where('code', 'LIKE', "%{$request->code}%");
            }
        }

        return $query->paginate(10);
    }

    public function create($input)
    {
        $input['created_by'] = auth()->user()->id;
        return Medication::create($input);
    }

    public function find($id)
    {
        return Medication::find($id);
    }

    public function update($medication, $request)
    {
        $medication->update($request);
        return $medication;
    }

    public function destroy($medication)
    {
        $user = Auth::user();
        if ($user->hasRole('owner')) {
            $medication->forceDelete();
        } else if($user->hasRole('manager')) {
            $medication->delete();   
        }
        return;
    }
}
 