<?php

namespace station\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use station\Mail\DataBundlesExpired;
use station\Station;

class stationDataBundleDone extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'station:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify station admin when data bundle is depleted';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $stations = Station::where('StationStatus', '=', 'on')
        ->where('closed', '=', null)
        ->get();
        foreach ($stations as $station) {
            $station_name = $station->StationName;
            foreach( $station->stationUsers as $user){
                $name = $user->name;
                dd($name);
                // Mail::to($user->email)->send(new DataBundlesExpired($name, $station_name));
            }
        }
    }
}
