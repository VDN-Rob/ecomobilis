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

class NotifyCarpoolRequestCancelled extends Mailable
{
    use Queueable, SerializesModels, SendGrid;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ride, User $user)
    {
        $this->ride            = $ride;
        $this->user            = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject = 'Le passager a annulé son trajet.';

        // MAIL ---------------------
        return $this->from('info@ecomobilis.be', 'Ecomobilis')
            ->view('emails.carpool-request-cancelled')
            ->with([
                'ride'         => $this->ride,
                'user'         => $this->user,
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
