<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Station;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['permission:user.view'])->only('index');
        // $this->middleware(['permission:user.edit'])->only('edit');
        // $this->middleware(['permission:user.delete'])->only('destroy');
        // $this->middleware(['permission:user.create'])->only('index');
    }
    public function index()
    {
        $users = User::all();
        // dd($users[0]->getRoleNames());
        return view('layouts.display_users', ['users' => $users]);
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
        $stationAttarched = Station::select('station_id', 'Location')->where("stationCategory", "aws")->get()->toArray();
        $stations = array();
        $station = Station::select('station_id', 'Location')->where("stationCategory", "aws")->get()->toArray();
        foreach ($station as $value) {
            $stations[$value['station_id']] = $value['Location'];

            # code...
        }

        //$users = DB::table('users')->where('id', $id)->first();
        $users = User::find($id);
        if (count(array($users)) > 0) {
            return view('auth.editUser', compact('stations', 'users', 'id', 'stationAttarched'));
        } else
            return view("layouts.display_users");
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
        $user = User::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->phone = $request->get('phone');
        $user->save();
        $users = User::orderByDesc('updated_at')->get();
        return view('layouts.display_users', ['users' => $users])->with('successEdit', 'Information has been edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        $users = User::all();
        return view('layouts.display_users', ['users' => $users])->with('success', 'Information has been  deleted');
    }
}
