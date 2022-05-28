<?php

namespace App\Mail;

use App\Models\myCompany;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderEmails extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $order = "PLEASE READ THIS EMAIL IN FULL AND PRINT IT FOR YOUR RECORDS";
        $message = "Thank you for your order from us! Your  account has now been setup and this email contains all the information you will need in order to begin using your account.";
        $url = "https://www.moxa.co.tz";
       $myaccount = myCompany::first();
        return $this->markdown('emails.orders.emails',compact('order','message','url','myaccount'));
    }
}
