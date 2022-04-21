<?php

namespace App\Console\Commands;

use App\Mail\Notification;
use App\Models\Scheduler;
use App\Notifications\SchedulerNotification;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Mail;

class SendNotificationsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function handle(): int
    {
        /** @var Collection $readyToBeSentNotifications */
        $readyToBeSentNotifications = Scheduler::ready()->get();

        $readyToBeSentNotifications->each(function(Scheduler $notification){
            if($notification->channel === 'mail'){
                // Mailable will queue by default due to ShouldQueue contract on the Mailable Class
                Mail::to($notification->email)->send(new Notification($notification));

                $notification->update(['sent_at' => now()]);
            }
        });

        return 0;
    }
}
