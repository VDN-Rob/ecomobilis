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

class NotifyCarpoolAccepted extends Mailable
{
    use Queueable, SerializesModels, SendGrid;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ride, User $user, $passenger)
    {
        $this->ride            = $ride;
        $this->user            = $user;
        $this->passenger       = $passenger;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject = 'Votre demande a été approuvée.';

        // MAIL ---------------------
        return $this->from('info@ecomobilis.be', 'Ecomobilis')
            ->view('emails.carpool-reservation-accepted')
            ->with([
                'ride'         => $this->ride,
                'user'         => $this->user,
                'passenger'    => $this->passenger,
            ])
            ->subject($this->subject)
            ->sendgrid([
                'categories'  => ['smart-mobility'],
                'custom_args' => [
                    "section"       => "smart-mobility",
                    "environment"   => App::environment(),
                ],
            ]);
    }
}
