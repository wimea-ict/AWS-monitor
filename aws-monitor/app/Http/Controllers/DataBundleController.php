<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;


use App\Models\DataBundles;
use App\Mail\DataBundlesExpired;
use App\Models\Station;
use App\Models\User;


class DataBundleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        dd("called");
        $station = $request->user()->station;
        $mobile_no = DataBundles::where('station_id', '=', $station)->orderBy('id', 'DSC')->get();

        return view('data bundles.index', ['data' => $mobile_no]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return ('hello');
        return view('data bundles.create');
        // return view('data bundles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $no_of_months = $request->input("month");
        // $date = Carbon::now()->addMonth($no_of_months)->format('Y-m-d');
        // $mobile_no = new DataBundles();
        // $mobile_no->station_id = $request->user()->station;
        // $mobile_no->mobile_number = $request->input("number");
        // $mobile_no->end_date = $date;
        // $mobile_no->save();


        // return redirect('/data_bundle');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $databundle = DataBundles::where('station_id', '=', $id)->get();
        $station = Station::find($id);
        return view('data bundles.show', ['data' => $databundle, 'id' => $id, 'station' => $station]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $databundle = DataBundles::find($id)->first();
        // dd($databundle);
        return view('data bundles.edit')->with("data", $databundle);
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
        $start = Carbon::parse($request->input('start'));
        $end = Carbon::parse($request->input('end'));
        $databundle = new DataBundles();
        $databundle->station_id = $id;
        $databundle->end_date = $end->format('Y-m-d');
        $databundle->load_date =$start->format('Y-m-d');
        $databundle->save();
        $station = Station::find($id);
        $station->expiry_date = $end->format('Y-m-d');
        $station->save();
        return redirect('/data_bundle/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $databundle = DataBundles::find($id)->first();
        $databundle->delete();
        return redirect('/data_bundle');
    }
}
