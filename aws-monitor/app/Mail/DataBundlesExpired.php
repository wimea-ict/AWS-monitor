<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DataBundlesExpired extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $station, $mobile_no, $no_of_days_remaining)
    {
        $this->name = $name;
        $this->station = $station;
        $this->mobile_no = $mobile_no;
        $this->no_of_days_remaining = $no_of_days_remaining;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown(
            'emails.dataBundleExpired',
            [
                'name' => $this->name,
                'station' => $this->station,
                'mobile_no' => $this->mobile_no,
                'no_of_days_remaining' => $this->no_of_days_remaining
            ]
        );
    }
}
