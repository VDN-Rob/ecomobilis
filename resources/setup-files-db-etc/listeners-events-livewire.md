#
php artisan make:resource CarpoolStreetCoordinateResource
php artisan make:resource CarpoolStreetReservationResource
php artisan make:resource CarpoolCarResource


# Just for info/reference

php artisan make:event CarpoolRequested
php artisan make:listener SendCarpoolRequestNotification --event=CarpoolRequested
php artisan make:listener StoreCarpoolRequestInDatabase --event=CarpoolRequested

php artisan make:event CarpoolReservationAccepted
php artisan make:listener SendCarpoolReservationAcceptedNotification --event=CarpoolReservationAccepted
php artisan make:listener StoreCarpoolReservationAcceptedInDatabase --event=CarpoolReservationAccepted

php artisan make:event CarpoolReservationRejected
php artisan make:listener SendCarpoolReservationRejectedNotification --event=CarpoolReservationRejected
php artisan make:listener StoreCarpoolReservationRejectedInDatabase --event=CarpoolReservationRejected

New messages are checked with a job


# livewire

php artisan make:livewire ShowMessages
