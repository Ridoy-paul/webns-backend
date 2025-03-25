<?php

namespace App\Jobs;

use App\Events\PrivateNotificationEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendEmail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //event(new PrivateNotificationEvent(4, 'This is a private notification.'));
    }
}
