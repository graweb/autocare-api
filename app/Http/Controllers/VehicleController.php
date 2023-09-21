<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Vehicle::get();
        return response($data, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'plate' => 'required',
        ];

        $messages = [
            'plate.required' => 'The :attribute field is required!',
        ];

        $data = Validator::make($request->all(), $rules, $messages);

        if ($data->fails()) {
            return $data->errors();
        } else {

            $data_inserted = Vehicle::create([
                'user_id' => Auth::user()->id,
                'plate' => strtoupper($data->validated()['plate']),
                'brand' => strtoupper($request->brand),
                'model' => strtoupper($request->model),
                'color' => strtoupper($request->color),
                'year' => $request->year,
                'year_model' => $request->year_model,
                'version' => $request->version,
                'chassi' => $request->chassi,
                'fuel' => strtoupper($request->fuel),
                'motor' => strtoupper($request->motor),
                'nationality' => strtoupper($request->nationality),
                'uf' => strtoupper($request->uf),
                'city' => strtoupper($request->city),
                'number_of_passengers' => $request->number_of_passengers,
            ]);

            return response($data_inserted, 201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        return response($vehicle, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $rules = [
            'plate' => 'required',
        ];

        $messages = [
            'plate.required' => 'The :attribute field is required!',
        ];

        $data = Validator::make($request->all(), $rules, $messages);

        if ($data->fails()) {
            return $data->errors();
        } else {

            $vehicle->update([
                'plate' => strtoupper($data->validated()['plate']),
                'brand' => strtoupper($request->brand),
                'model' => strtoupper($request->model),
                'color' => strtoupper($request->color),
                'year' => $request->year,
                'year_model' => $request->year_model,
                'version' => $request->version,
                'chassi' => $request->chassi,
                'fuel' => strtoupper($request->fuel),
                'motor' => strtoupper($request->motor),
                'nationality' => strtoupper($request->nationality),
                'uf' => strtoupper($request->uf),
                'city' => strtoupper($request->city),
                'number_of_passengers' => $request->number_of_passengers,
            ]);

            return response($vehicle, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        $data = $vehicle::destroy($vehicle->id);

        if ($data) {
            return response(['message' => 'Deleted successfuly.'], 200);
        }

        return response(['message' => 'Not found'], 404);
    }
}
