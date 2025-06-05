<?php

namespace App\Providers;

use App\Events\CarpoolMessageAdded;
use App\Events\CarpoolRequested;
use App\Events\CarpoolReservationAccepted;
use App\Events\CarpoolReservationRejected;
use App\Listeners\SendCarpoolMessageNotification;
use App\Listeners\SendCarpoolRequestNotification;
use App\Listeners\StoreCarpoolRequestInDatabase;

use App\Listeners\SendCarpoolReservationAcceptedNotification;
use App\Listeners\StoreCarpoolReservationAcceptedInDatabase;

use App\Listeners\SendCarpoolReservationRejectedNotification;
use App\Listeners\StoreCarpoolReservationRejectedInDatabase;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        // just a request
        CarpoolRequested::class => [
            SendCarpoolRequestNotification::class,
            StoreCarpoolRequestInDatabase::class,
        ],
        // accepted
        CarpoolReservationAccepted::class => [
            SendCarpoolReservationAcceptedNotification::class,
            StoreCarpoolReservationAcceptedInDatabase::class,
        ],
        // rejected
        CarpoolReservationRejected::class => [
            SendCarpoolReservationRejectedNotification::class,
            StoreCarpoolReservationRejectedInDatabase::class,
        ],


    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
