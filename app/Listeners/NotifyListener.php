<?php

namespace App\Listeners;

use App\Events\CheckOutSuccessEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CheckOutSuccessEvent $event)
    {
        // $order=$event->order;
        // return view('checkout_success',compact('order'));
    }
}
