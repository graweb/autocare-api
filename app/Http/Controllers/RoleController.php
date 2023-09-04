<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Role::paginate();
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
            'name' => 'required|string|unique:roles|max:60',
        ];

        $messages = [
            'name.required' => 'The :attribute field is required!',
            'name.unique' => 'The :attribute field already exists!',
            'name.max' => 'The :attribute must be :max characters!'
        ];

        $data = Validator::make($request->all(), $rules, $messages);

        if ($data->fails()) {
            return $data->errors();
        } else {

            $data_inserted = Role::create([
                'name' => $data->validated()['name'],
                'guard_name' => 'web',
            ]);

            foreach ($request->permissions as $permission) {
                if (isset($permission['checked'])) {
                    $data_inserted->givePermissionTo($permission['name']);
                }
            }

            return response($data_inserted, 201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $data = Role::find($role->id);
        return response($data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $rules = [
            'name' => 'required|string',
        ];

        $messages = [
            'name.required' => 'The :attribute field is required!',
        ];

        $data = Validator::make($request->all(), $rules, $messages);

        if ($data->fails()) {
            return $data->errors();
        } else {

            $role->update([
                'name' => $data->validated()['name'],
            ]);

            foreach ($request->permissions as $key => $permission) {
                if ($permission['checked']) {
                    $arr[$key] = ['name' => $permission['name']];
                }
            }

            $role->syncPermissions($arr);

            return response($role, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $data = Role::destroy($role->id);

        if($data) {
            return response(['message' => 'Deleted successfuly.'], 200);
        }

        return response(['message' => 'Not found'], 404);
    }
}
