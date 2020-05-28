<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Timeregistration;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;

class TimeregistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Timeregistration::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = auth('api')->user()->id;

        $this->validate($request, [
            'date' => 'required',
            'check_in' => 'required',
            'check_out' => 'required',
                        
        ]);

        return Timeregistration::create([
            'date' => $request['date'],
            'check_in' => $request['check_in'],
            'check_out' => $request['check_out'],
            'break_time' => $request['break_time'],
            'hours_worked' => $request['hours_worked'],
            'user_id' =>  $user_id,
            'comments' => $request['comments'],
            /*'approval_status' => $request['approval_status'],*/
            'worked_hotel' => $request['worked_hotel'],
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
        $user_id = auth('api')->user()->id;
        $timeregistration = DB::table('timeregistrations')->where('user_id', '=', $user_id)->get();
        return $timeregistration;
    }

    public function showAllSupervisor()
    {
        $user_id = auth('api')->user()->id;
        $user_workplace = auth('api')->user()->primary_workplace;
        $timeregistration = DB::table('timeregistrations')->where('worked_hotel', '=', $user_workplace)->get();
        return $timeregistration;
    }

    public function showAllAdmin()
    {
        $user_id = auth('api')->user()->id;
        $timeregistration = DB::table('timeregistrations')->where('user_id', '<>', $user_id)->get();
        return $timeregistration;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showApprovals()
    {
        $user_id = auth('api')->user()->id;
        $timeregistration = DB::table('timeregistrations')
        ->where('user_id', '<>', $user_id)
        ->where('approval_status', '=', 0)
        ->get();
        return $timeregistration;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showApprovalsAll()
    {
        $user_id = auth('api')->user()->id;
        $timeregistration = DB::table('timeregistrations')
        ->where('user_id', '<>', $user_id)
        ->where('approval_status', '=', 0)
        ->get();
        return $timeregistration;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showApprovalsSupervisor()
    {
        $user_id = auth('api')->user()->id;
        $timeregistration = DB::table('timeregistrations')->where('user_id', '=', $user_id)->get();
        return $timeregistration;
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

        $timeregistration = Timeregistration::findOrFail($id);

        $this->validate($request, [
            'date' => 'required',
            'check_in' => 'required',
            'check_out' => 'required',
            'hours_worked' => 'required',
        ]);

        $timeregistration->update($request->all());
        return ['message' => 'succesfully updated timeregistration'];
    }
 

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $timeregistration = Timeregistration::findOrFail($id);

        //delete the user
        $timeregistration->delete();

        return ['message' => 'Timeregistration deleted'];
    }
}
