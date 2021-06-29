<?php

namespace App\Console\Commands;

use App\Models\Invitation;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendPlakatReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:plakatReminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder email for sending plakat to user';

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
     * @return int
     */
    public function handle()
    {
        \Log::info("Cron job is working fine");

        $invitations = Invitation::with('user')
                            ->where('status', 'accepted')
                            ->where('plakat_status', 'belum')
                            ->whereDate('event_date', '<', Carbon::today())
                            ->get();

        if ($invitations->count() != 0) {
            foreach ($invitations as $key => $invitation) {
                Mail::to($invitation->user->email)->send(new \App\Mail\PlakatReminderMail($invitation));
            }
        }
    }
}
