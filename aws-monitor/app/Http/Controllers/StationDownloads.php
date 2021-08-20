<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Station;

class StationDownloads extends Controller
{
  public function __construct()
  {
      $this->middleware(['permission:downloads']);
  }
  //
  public function index()
  {


    $files = [];

    $name = '';

    // $userId = Auth::id();
    // $userdetails = User::all()->where("id", $userId)->toArray();

    // foreach ($userdetails as $u) {
    //   if ($u['station'] != NULL) {

    //     $stationName = Station::select('StationName')->where('station_id', $u['station'])->get('StationName');

    //     $stationLocation = Station::select('Location')->where('station_id', $u['station'])->get('Location');


    //     foreach ($stationName as $s) {
    //       foreach ($stationLocation as $m) {
    //         try {

    //           $str = $s['StationName'];
    //           $str2 = $m['Location'];

    //           $glob = glob(public_path() . "/stationsData/cleanedData/*.csv");

    //           $parttern = "/" . $str . "/i";
    //           $parttern2 = "/" . $str2 . "/i";

    //           $p = "/-/";
    //           $und = "/_/";

    //           $lits = array();

    //           if (preg_match($p, $str2) == 1) {
    //             $lits = explode("-", $str2);
    //             $parttern2 = "/" . $lits[1] . "/i";
    //           }

    //           foreach ($glob as $x) {
    //             $name = basename($x);
    //             $target = preg_match($parttern, $name);
    //             $target2 = preg_match($parttern2, $name);

    //             if (($target == 1) || ($target2 == 1)) {
    //               array_push($files, $name);
    //             }
    //           }


    //           return view('reports.downloads', compact('files'));
    //         } catch (\Throwable $th) {
    //           echo ("<html><body><h1>no such file yet</h1></body></html>");
    //         }
    //       }
    //     }
    //   }
    // }


    $glob = glob(public_path() . "/stationsData/cleanedData/*.csv");

    foreach ($glob as $x) {
      $name = basename($x);
      array_push($files, $name);
    }

    return view('reports.downloads', compact('files'));
  }
}
