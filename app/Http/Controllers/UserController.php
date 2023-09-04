<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::paginate();
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
            'role' => 'required',
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ];

        $messages = [
            'role.required' => 'The :attribute field is required!',
            'name.required' => 'The :attribute field is required!',
            'email.unique' => 'The :attribute field alread exists!',
            'email.required' => 'The :attribute field is required!',
            'email.email' => 'The :attribute field is not valid!',
            'password.required' => 'The :attribute field is required!',
        ];

        $data = Validator::make($request->all(), $rules, $messages);

        if ($data->fails()) {
            return $data->errors();
        } else {

            $data_inserted = User::create([
                'role_id' => $data->validated()['role']['id'],
                'name' => $data->validated()['name'],
                'email' => $data->validated()['email'],
                'password' => Hash::make($data->validated()['password']),
            ]);

            $data_inserted->assignRole($data->validated()['role']['name']);

            return response($data_inserted, 201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $data = User::find($user->id);
        return response($data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'role' => 'required',
            'name' => 'required|string',
            'email' => 'required|email',
        ];

        $messages = [
            'role.required' => 'The :attribute field is required!',
            'name.required' => 'The :attribute field is required!',
            'email.required' => 'The :attribute field is required!',
            'email.email' => 'The :attribute field is not valid!',
        ];

        $data = Validator::make($request->all(), $rules, $messages);

        if ($data->fails()) {
            return $data->errors();
        } else {

            $user->update([
                'role_id' => $data->validated()['role']['id'],
                'name' => $data->validated()['name'],
                'email' => $data->validated()['email'],
            ]);

            $user->syncRoles($data->validated()['role']['name']);

            return response($user, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $data = User::destroy($user->id);

        if($data) {
            return response(['message' => 'Deleted successfuly.'], 200);
        }

        return response(['message' => 'Not found'], 404);
    }
}
