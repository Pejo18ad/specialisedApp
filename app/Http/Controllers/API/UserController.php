<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Image;
use Auth;
use DB;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('api');
    }
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
            'position' => $request['position'],
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
    public function show()
    {
        $user_workplace = auth('api')->user()->primary_workplace;
        $user_id = auth('api')->user()->id;
        $usersSupervisor = DB::table('users')->
        where('primary_workplace', '=', $user_workplace)->
        where('id', '<>', $user_id)->get();
        return $usersSupervisor;
    }

    public function showAll()
    {
        $user_id = auth('api')->user()->id;
        $usersSupervisor = DB::table('users')->where('id', '<>', $user_id)->get();
        return $usersSupervisor;
    }

    public function profile()
    {
        return auth('api')->user();
    }

    public function updateProfile(Request $request)
    {
        $user = auth('api')->user();
        $currentPhoto = $user->photo;

        if ($request->photo != $currentPhoto) {
            $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];

            \Image::make($request->photo)->save(public_path('img/profile/').$name);
            $request->merge(['photo' => $name]);

            $userPhoto = public_path('img/profile/').$currentPhoto;
            if (file_exists($userPhoto)) {
                @unlink($userPhoto);
            }
        }

        $user->update($request->all());
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

        $user = User::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'password' => 'sometimes|string|min:2',
        ]);
        

        $user->update($request->all());
        return ['message' => 'succesfully updated employee'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        //delete the user
        $user->delete();

        return ['message' => 'Employee deleted'];
    }
}
