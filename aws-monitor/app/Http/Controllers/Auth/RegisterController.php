<?php

namespace station\Http\Controllers\Auth;

use station\Models\User;
use station\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use \Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use station\Models\maillist;
use Illuminate\Support\Facades\DB;
use station\Models\Station;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    public function index()
    {
        $stations = array();
        $station = Station::select('station_id', 'Location')->where("stationCategory", "aws")->get()->toArray();
        foreach ($station as $value) {
            $stations[$value['station_id']] = $value['Location'];

            # code...
        }
        $users = User::orderByDesc('updated_at')->get();
        return view('layouts.display_users', ['users' => $users], compact('stations'));
    }

    use RegistersUsers;

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
    public function __construct()
    {
        //$this->middleware('guest');
    }

    public function register(Request $request)
    {
        $stations = array();
        $station = Station::select('station_id', 'Location')->where("stationCategory", "aws")->get()->toArray();
        foreach ($station as $value) {
            $stations[$value['station_id']] = $value['Location'];

            # code...
        }

        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // $this->guard()->login($user);
        $this->registered($request, $user);
        $users = User::orderByDesc('updated_at')->get();
        $this->mailsend();

        return view('layouts.display_users', compact('stations'), ['users' => $users])->with('registerUser', 'A new member has been registered successfully and added to the maillist');
        //return $this->registered($request, $user)
        //            ?: redirect($this->redirectPath());
    }

    public function showRegistrationForm()
    {

        $stationsAttachedTo = array();


        $stationsAttachedTo = Station::select('station_id', 'Location')->where("stationCategory", "aws")->get()->toArray();

        return view('auth.register', compact('stationsAttachedTo'));
    }
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
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'station' => 'string|max:255',
            'password' => 'required|string|min:6|confirmed',
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
            'phone' => $data['phone'],
            'station' => $data['locat'],
            'password' => bcrypt($data['password']),
        ]);
    }

    protected function mailsend()
    {

        //protected $fillable = ['id','userID','stationID','status'];
        //SELECT * FROM `users` ORDER BY `id` DESC LIMIT 1

        $newUserDetails = array();
        $newUserDetails = User::all()->toArray();

        foreach ($newUserDetails as $u) {
            $userId = $u['id'];
            $station = $u['station'];
        }

        $data = array("userID" => $userId, "stationID" => $station);

        DB::table('maillist')->insert($data);
    }
}
