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

class NotifyCarpoolRidesUpcoming extends Mailable
{
    use Queueable, SerializesModels, SendGrid;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($rides, User $user)
    {
        $this->rides            = $rides;
        $this->user             = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject = 'Vos prochains trajets de covoiturage';

        // MAIL ---------------------
        return $this->from('info@ecomobilis.be', 'Ecomobilis')
            ->view('emails.carpool-rides-upcoming-list')
            ->with([
                'rides'        => $this->rides,
                'user'         => $this->user,
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
