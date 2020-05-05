<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:2',
        ]);

        return User::create([
            'name' => $request['name'],
            'phone_number' => $request['phone_number'],
            'date_birth' => $request['date_birth'],
            'nationality' => $request['nationality'],
            'gender' => $request['gender'],
            'adress' => $request['adress'],
            'primary_workplace' => $request['primary_workplace'],
            'supervisor' => $request['supervisor'],
            'contract_hours' => $request['contract_hours'],
            'hiring_date' => $request['hiring_date'],
            'employment_type' => $request['employment_type'],
            'wp_expDate' => $request['wp_expDate'],
            'bio' => $request['bio'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'permission_level' => $request['permission_level'],
            'photo' => $request['photo'],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
