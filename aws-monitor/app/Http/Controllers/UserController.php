<?php

namespace station\Http\Controllers;

use station\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use station\User;
use station\Station;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

        $users = DB::table('users')->get();
        return view('layouts.display_users',compact('stations'), ['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stationAttarched = Station::select('station_id','Location')->where("stationCategory","aws")->get()->toArray();
          $stations = array();
        $station = Station::select('station_id','Location')->where("stationCategory","aws")->get()->toArray();
        foreach ($station as $value) {
            $stations[$value['station_id']]=$value['Location'];

            # code...
        }

        //$users = DB::table('users')->where('id', $id)->first();
        $users = User::find($id);
        if(count(array($users))>0){
            return view('auth.editUser', compact('stations','users', 'id','stationAttarched'));
        }
        else
            return view(layouts.display_users);
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
          $stations = array();
        $station = Station::select('station_id','Location')->where("stationCategory","aws")->get()->toArray();
        foreach ($station as $value) {
            $stations[$value['station_id']]=$value['Location'];

            # code...
        }
        $user= User::find($id);
        $user->name=$request->get('name');
        $user->email=$request->get('email');
        $user->phone=$request->get('phone');
        $user->station=$request->get('admin');

        // $user->password=bcrypt($request->get('password'));
        $user->save();
        $users = User::orderByDesc('updated_at')->get();
        return view('layouts.display_users',compact('stations'), ['users'=>$users])->with('successEdit', 'Information has been edited successfully');
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
          $stations = array();
        $station = Station::select('station_id','Location')->where("stationCategory","aws")->get()->toArray();
        foreach ($station as $value) {
            $stations[$value['station_id']]=$value['Location'];

            # code...
        }
        $user = User::find($id);
        $user->delete();
        $users = DB::table('users')->get();
        return view('layouts.display_users',compact('stations'), ['users'=>$users])->with('success','Information has been  deleted');
    }
}
