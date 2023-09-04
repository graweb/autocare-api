<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RoleHasPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Permission::paginate();
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

            $data_inserted = Permission::create([
                'name' => strtolower($data->validated()['name']),
                'guard_name' => 'web',
            ]);

            $roles = Role::find(1);
            $roles->givePermissionTo($data_inserted);

            return response($data_inserted, 201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        $data = Permission::find($permission->id);
        return response($data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
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

            $permission->update([
                'name' => strtolower($data->validated()['name']),
            ]);

            $roles = Role::find(1);
            $roles->givePermissionTo($permission);

            return response($permission, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permissionHasPermission = RoleHasPermission::where('permission_id', $permission->id)->get();
        if ($permissionHasPermission) {
            for ($i = 0; $i < count($permissionHasPermission); $i++) {
                RoleHasPermission::where('permission_id', $permissionHasPermission[$i]->permission_id)->delete();
            }
        }

        $data = Permission::destroy($permission->id);
        if($data) {
            return response(['message' => 'Deleted successfuly.'], 200);
        }

        return response(['message' => 'Not found'], 404);
    }
}
