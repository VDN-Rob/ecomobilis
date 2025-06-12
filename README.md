# 0. Internal notes
## TO DO
https://saasykit.com/blog/how-to-generate-documentation-for-your-laravel-project

## CHECK THE WEBSITE, FOR NOW:
admin / ecoadmin
git update-index --assume-unchanged public/.htaccess
git update-index --no-assume-unchanged public/.htaccess

-----------------------
# 1. Tech 

## Framework
Laravel 10  https://laravel.com/docs/10.x/deployment#server-requirements

## Frontend (Laravel mix)
- Where to edit:  uses the files resources/js/main.js and resources/sass/...
- Paths and files for css and js etc defined in webpack.mix.js + config with package.json
- Compile it with: npm run watch / npm run production

## Jobs
To start it locally:
-  `php artisan queue:listen database --tries=1`

## Commands
- `php artisan CarpoolSendUserUpcomingRides:daily`

## How to get streets?
- https://locationiq.com/demo#autocomplete -->  uses open street maps

## JS packages
- Autocomplete used for street lookup https://github.com/TarekRaafat/autoComplete.js

## Laravel packages
- https://github.com/msurguy/Honeypot/tree/master
- Laravel ER Diagram Generator



# 2. Database
MySQL v5.7
![alt text](graph.png "database ER diagnram")
(Generated with https://github.com/beyondcode/laravel-er-diagram-generator)

# 3. Carpool

## Locations
To get locations we use the external Locationiq api. This service uses Open Street Maps and can possible options for streets, city based on a search query.
So it converts a structured or free-form address to geographical coordinates. We screened for fully open and free location services but there are none. LocationIQ seems suited and most clear pricing. 
It can be used for free for a 5000 requests /day and 2 requests / sec.
When a location is submitted we store the coordinates in the db table carpool_street_coordinates to be able to reference to that location.

## Cities autocomplete
The UI for the location selection uses the open source vanilla javascript  library https://github.com/TarekRaafat/autoComplete.js.
We store the json in a hidden field below the input field. It's the hidden field we use in the database.

## Messages
A message thread is always linked towards a specific ride. The thread forms itself by combining the sender (user_id), receiver (conversation_partner_user_id) and the ride (car_ride_id)

There is a special type of message, the 'auto-message' which is basically a message triggered by an external request, eg a request for a car ride. The auto message appears in the thread with a fixed message in a slightly different layout.

## Mails
- When a reservation is requested (event CarpoolRequested)
- When a reservation is confirmed (event CarpoolReservationAccepted)
- When a reservation is rejected (event CarpoolReservationRejected)
- When a chat happened (job CarpoolMessageAdded)
- Every morning overview of your upcoming rides (Console/Kernel - carpoolSendUserUpcomingRides:daily 06:00) 

## Carpool matching
Matching is done based on the stored gps coordinates and looks within 20km radius for both departure and arrival and for your the date / hour given or later

# 9. Hosting
The hosting of http://ecomobilis.be/ is now at Combell (combell.com). (S)FTP access can be provided, just email dave@telraam.net

# 10. Design 

## Fonts
DM Sans as main font (https://fonts.google.com/specimen/DM+Sans)
Barlow Condensed for narrow headers (https://fonts.google.com/specimen/Barlow+Condensed)
