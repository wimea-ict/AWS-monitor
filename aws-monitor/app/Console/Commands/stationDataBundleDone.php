<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\DataBundles;
use App\Mail\DataBundlesExpired;
use App\Models\Station;

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
        $date_5_days_from_now = Carbon::now()->addDay(5)->format('Y-m-d');
        $expiring = Station::where("expiry_date", '<', $date_5_days_from_now)
            ->get();
        foreach ($expiring as $ex) {
            $mobile_no = $ex->phone;
            $no_of_days_remaining = Carbon::now()->diff(Carbon::parse($ex->expiry_date))->format("%r%a");
            $station = $ex->StationName;
            $user = $ex->user;
            Mail::to($user->email)->send(new DataBundlesExpired($user->name, $station, $mobile_no, $no_of_days_remaining));
        }
    }
}
