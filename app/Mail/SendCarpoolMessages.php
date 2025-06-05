<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Attendee;
use App\Models\CarpoolMessage;
use Illuminate\Support\Facades\Log;
use Sichikawa\LaravelSendgridDriver\SendGrid;
use App;
use Storage;

class SendCarpoolMessages extends Mailable
{
    use Queueable, SerializesModels, SendGrid;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $ride;
    private $user;
    private $conversationPartner;
    private $bodyEmail;

    public function __construct($ride, $user, $conversationPartner, $bodyEmail)
    {
        Log::debug('SendCarpoolMessages From '. $user->email .' -> '.$conversationPartner->email);
        $this->ride = $ride;
        $this->user = $user;    // from
        $this->conversationPartner = $conversationPartner;  // to
        $this->bodyEmail = $bodyEmail;
    }



    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject = 'Covoiturage: messages de '.$this->user->firstname ;

        // MAIL ---------------------
        return $this->from('info@ecomobilis.be', 'Ecomobilis')
            ->view('emails.carpool-message')
            ->with([
                'ride'         => $this->ride,
                'user'         => $this->user, // from
                'passenger'    => $this->conversationPartner, // to
                'bodyEmail'    => $this->bodyEmail
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
