<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Attendee;
use App\Models\User;
use Sichikawa\LaravelSendgridDriver\SendGrid;
use App;
use Storage;

class NotifyCarpoolRequested extends Mailable
{
    use Queueable, SerializesModels, SendGrid;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ride, User $user, $amount)
    {
        $this->ride            = $ride;
        $this->user            = $user;
        $this->amount          = $amount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject = 'Vous avez une nouvelle demande';

        // MAIL ---------------------
        return $this->from('info@ecomobilis.be', 'Ecomobilis')
            ->view('emails.carpool-request')
            ->with([
                'ride'         => $this->ride,
                'user'         => $this->user,
                'amount'       => $this->amount,
            ])
            ->subject($this->subject)
            ->sendgrid([
                'categories'  => ['smart-mobility'],
                'custom_args' => [
                    "section"       => "ecomobilis",
                    "environment"   => App::environment(),
                ],
            ]);
    }
}
