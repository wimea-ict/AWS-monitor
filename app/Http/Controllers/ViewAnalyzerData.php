<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use station\Http\Controllers\Controller;

class ViewAnalyzerData extends Controller
{
    public function showProbTable()
    {
        //get data in problems table   problems
        //source, source_id, criticality, classification_id, track_counter, status
        $data = DB::table('problems')->get();
        $problems = DB::table('problem_classification')->get();

        // return $data;
        return view('layouts.analyzer', compact('data','problems'));
    }
}
