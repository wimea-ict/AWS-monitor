<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;
use station\Http\Controllers\Controller;
use DB;
use station\Report;
use Carbon\Carbon;
use Twilio\Rest\Client;
use Log;

class ReportController extends Controller
{
    public function report(){
        //get all the problems with status reported
        
        $reported_problems = DB::table('problems')
                ->where('status','reported')->get();

        foreach($reported_problems as $problem){
            //check if the problem exists in the reports table

            //get the problems orign station to determine report method
            // return array($problem->source,$problem->source_id);
            $problem_station=$this->getStationId($problem->source,$problem->source_id);
            
            $mstation_id=$problem_station["station_id"];

            
            $m_node=$problem->source;


            $problem_report=DB::table('reports')
                ->where('problem_id',$problem->id)->orderBy('report_id', 'desc')->first();
            
            //get reporting type
            $reporting_mthd_interval=DB::table("station_problem_settings")
                            ->select("report_method","reporting_time_interval")
                            ->where('classification_id',$problem->classification_id)
                            ->where('station_id',$problem_station["station_id"])->first();
                        
            $problem_description=DB::table('problem_classification')
                ->select("problem_description")
                ->where('id',$problem->classification_id)->first();

            

            if(!empty($reporting_mthd_interval)){
                $reporting_type=$reporting_mthd_interval->report_method;
                $interval=$reporting_mthd_interval->reporting_time_interval;
               
            }else{
                //use default
                $reporting_type="email";
                
                $interval=10;
            }
            
            
                
            if(empty($problem_report)){

                //insert the problem
                Report::create([
                    "problem_id"=>$problem->id,
                    "message"=>$problem_station["source"],
                    "report_counter"=>1,
                    "station_id"=>$mstation_id,
                    "node"=>(($m_node=="station")?"":$m_node)
                    ]);

                //report the problem
                $message=$problem_station["source"]." \n".$problem_description->problem_description;
                $this->sendReport($reporting_type,$problem_station["source"],$message);
            }else{

                $date=Carbon::parse($problem_report->datetime);

                
                $now = Carbon::now();
                $now=$now->addHours(3);//to change it to east african time
                
                $diff = $date->diffInHours($now);

                if($diff>=$interval){

                    Report::create([
                    "problem_id"=>$problem->id,
                    "message"=>$problem_station["source"],
                    "report_counter"=>(++$problem_report->report_counter),
                    "station_id"=>$mstation_id,
                    "node"=>(($m_node=="station")?"":$m_node)
                    
                    ]);
                    
                    $message=$problem_station["source"]." ".$problem_description->problem_description;
                    $this->sendReport($reporting_type,$problem_station["source"],$message);
                }else{
                    //do nothing
                }
                
                //check time difference btn now and last reporting time

                //get the problem description from problem configuration table 
                //check reporting type and report the problem
                

                
            }
        }

        // return $reported_problems;

    }

    public function sendReport($type,$source,$message1){

        if($type=="sms"){
            //send via sms

            // Get form inputs
        $number = "+256706440588";
        $message = $message1;
        
        // Create an authenticated client for the Twilio API

        $client = new Client(env('TWILIO_ACCOUNT_SID'), env('MTWILIO_AUTH_TOKEN'));
        
        
        // Use the Twilio REST API client to send a text message
        try {
            $m=$client->messages->create(
                $number,// the phone number the text will be sent to
                array(
                    'from' => env('TWILIO_NUMBER'),
                    'body' => $message// the body of the text message
                )
            );
            return "okay";
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return $e->getMessage();
        }

        //end sms 
        }else if($type=="email"){
            //send via email
            \Mail::raw($message1, function($message)
            {
                $message->subject('WIMEA ICT REPORT');
                $message->from('byarus90@gmail.com', 'WIMEA ICT');
                $message->to('kibsysapps@gmail.com');
            });

        }else if($type=="both"){
            //use both email and sms

            //send via email
            \Mail::raw($message1, function($message)
            {
                $message->subject('WIMEA ICT REPORT');
                $message->from('byarus90@gmail.com', 'WIMEA ICT');
                $message->to('kibsysapps@gmail.com');
            });
        }

    }

    //this method is used to get station id depending on problem source and source id
    public function getStationId($source,$source_id){
        $data=array();
        switch($source){
            case "2m_node":
                //get station id and station name from 2m_node table
              $two_meter=DB::table('twometernode')
                ->join('stations','stations.station_id','=','twometernode.station_id')
                ->select('twometernode.station_id as station_id','stations.StationName as StationName')
                ->where('twometernode.node_id',$source_id)->get();

                $data["source"]=$two_meter[0]->StationName."'s "."2m Node";
                $data["station_id"]=$two_meter[0]->station_id;
                
            break;

            case "10m_node":
                //get station id from 10m node table
                $ten_meter=DB::table('tenmeternode')
                ->join('stations','stations.station_id','=','tenmeternode.station_id')
                ->select('tenmeternode.station_id as station_id','stations.StationName as StationName')
                ->where('tenmeternode.node_id',$source_id)->get();

                $data["source"]=$ten_meter[0]->StationName."'s "."10m Node";
                $data["station_id"]=$ten_meter[0]->station_id;
            break;

            case "sink_node":
                //get station_id from sink node table
                $sink_node=DB::table('sinknode')
                ->join('stations','stations.station_id','=','sinknode.station_id')
                ->select('sinknode.station_id as station_id','stations.StationName as StationName')
                ->where('sinknode.node_id',$source_id)->get();

                $data["source"]=$sink_node[0]->StationName."'s "."Sink Node";
                $data["station_id"]=$sink_node[0]->station_id;
            break;

            case "ground_node":
                //get station id from grnode table 

                //
                $ground_node=DB::table('groundnode')
                ->join('stations','stations.station_id','=','groundnode.station_id')
                ->select('groundnode.station_id as station_id','stations.StationName as StationName')
                ->where('node_id',$source_id)->get();

                $data["source"]=$ground_node[0]->StationName."'s "."Ground Node";
                $data["station_id"]=$ground_node[0]->station_id;
            break;

            case "sensor":

            break;

            case "station":
                $station=DB::table('stations')
                ->select('StationName')
                ->where('station_id',$source_id)->get();

                $data["source"]=$station[0]->StationName."'s ";
                $data["station_id"]=$source_id;
            break;
        }
        
        return $data;
    }
}
