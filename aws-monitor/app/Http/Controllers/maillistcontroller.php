<?php

namespace App\Http\Controllers;


use App\layouts;
use App\Models\maillist;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Station;
use Illuminate\Support\Facades\Validator;
//use Illuminate\Foundation\Auth\maillist;
use \Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;


class maillistController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | maillist  Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles addition of new maillist recipients to "contacts.txt"
    |
    */
    public function __construct()
    {
        $this->middleware(['permission:maillist']);
    }
    public function index()
    {
        $stations = Station::all();
        return view('layouts.maillisttable', ['stations' => $stations]);
    }



    // use maillist;
    public function showmaillistForm()
    {
        return view('auth.maillist');
    }
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/addstation';
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',

        ]);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \station\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],

        ]);
    }


    public function show()
    {
        return view('layouts.maillisttable')->with('success', 'Information has been  deleted');
    }

    public function destroy($id)
    {
        //
        $userdel = maillist::find($id);
        $status = 0;

        // $userdel->update(array('status'=>$status));

        $userdel = DB::table('maillist')->where('id', '=', $id)->update(['status' => 0]);
        $user_emails = DB::table('maillist')->get();
        //$user_email = [];
        return redirect('/maillisttable');
        //return view('layouts.maillisttable', compact('user_email'))->with('success','Information has been  deleted');
    }
}
