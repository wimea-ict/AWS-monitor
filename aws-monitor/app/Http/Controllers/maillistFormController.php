<?php

namespace station\Http\Controllers;

use App\layouts;
use station\Station;
use station\maillist;
use station\User;
use DB;
use Illuminate\Http\Request;

//so this is the controller used by the mail list form 
class maillistFormController extends Controller
{
    public function index(){
        $username = array();
        $stationsAttachedTo = array();
        $registeredmaillistUser = array();
        
        //"SELECT id,Name FROM users"
        $username = User::select('id','name')->get()->toArray();

        //"SELECT station_id,Location FROM stations WHERE StationCategory= 'aws'"
        $stationsAttachedTo = Station::select('station_id','Location')->where("stationCategory","aws")->get()->toArray();

        //"SELECT userID,stationID FROM maillist"
        $registeredmaillistUser = maillist::select('userID','stationID')->get()->toArray();

       
        return view('auth.maillistForm', compact('username', 'stationsAttachedTo', 'registeredmaillistUser'));

    }

    /*so we can have three cases here...whlie inserting
     1) the user is new on the mailing list so we'd just add them
     2) the user was *deleted* from the list ...
        2.1) deleted users' records are retained but the status value is updated to..
        2.2) 0 - to indicate that user won't receive any mail
        2.3) 1 - to indicate that they'll receive
        2.4) if a user is ever been on the list but was *deleted*, we'd just update the 0 to 1 since we still have the records
     3) they're already attached to a particular station so we need to avoid a duplicate of that similar station     
    */
   public function insert(Request $request){
        $userId = $request ->input('urname');
        $location = $request ->input('locat');
        $duplicateUser = array();
        $data = array("userID"=>$userId,"stationID"=>$location);
        
        //SELECT `userID`, `stationID`, `status` FROM `maillist` WHERE `userID`= 32 AND `stationID`=48 AND `status` = 0
        $duplicateUser = maillist::select('userID','stationID','status')->where('stationID','=',$location)->where('status','=',0)->where('userID','=',$userId)->get()->toArray();
        $ActiveUsers = maillist::select('userID','stationID','status')->where('stationID','=',$location)->where('status','=',1)->where('userID','=',$userId)->get()->toArray();

        if (sizeof($duplicateUser) != 0){
            //case 2.4
            DB::table('maillist')->where('userID',$userId)->where('stationID',$location)->update(['status'=> 1]);
        }else{

            if (sizeof($ActiveUsers) != 0){
                //case 3
                //we just redirect to maillistable since the user already exists
                return redirect('maillisttable'); 
            }else{
                //case 1
                DB::table('maillist')->insert($data);
            }
            
        }

        return redirect('maillisttable');
   }
}
