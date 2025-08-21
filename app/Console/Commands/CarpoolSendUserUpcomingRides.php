<?php

namespace App\Console\Commands;

use App\Models\CarpoolRide;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Console\Command;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use \Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyCarpoolRidesUpcoming;

class CarpoolSendUserUpcomingRides extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'carpoolSendUserUpcomingRides:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Triggers email to users with upcoming rides';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }



    public function handle() {

        Log::debug('===========================================================');
        Log::debug('------- CarpoolSendUserUpcomingRides Daily --------------');

        $allUsers = User::all();

        foreach($allUsers as $user) {
            $yesterday      = Carbon::now()->startOfMonth();
            $twoDaysLater   = Carbon::now()->addDays(3);
            $rides = CarpoolRide::where('travel_start_datetime', '>', $yesterday)
                                ->where('travel_start_datetime', '<', $twoDaysLater)
                                ->where('user_id', $user->id)
                                ->orderBy('travel_start_datetime')->get();
            if($rides->count() > 0 && !empty($user->email)) {
                Log::debug('CarpoolSendUserUpcomingRides '.$user->id.' mail to be send to '.$user->email);
                Mail::to($user->email)->send(new NotifyCarpoolRidesUpcoming($rides, $user));
            }
        }

        Log::debug('------- / CarpoolSendUserUpcomingRides Daily DONE --------------');

    }



}
