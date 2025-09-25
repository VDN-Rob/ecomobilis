# 1. Tech 

## Framework
Laravel 10  

## (Server) Requirements
- PHP ^8.1
- Composer
- Node.js & NPM
- MySQL/Postgres (or your preferred database)
- Laravel 10
- Laravel Livewire ^3.x
- MySQL v5.7
More info https://laravel.com/docs/10.x/deployment#server-requirements

## ⚙️ Installation
1. Clone the repository:
```bash
git clone https://github.com/Telraam-Rear-Window-BV/ecomobilis.git
cd your-project
```
2.Install PHP dependencies: composer install
3.Install front-end dependencies: see below
4.Copy the environment file and configure:
```
cp .env.example .env
php artisan key:generate
```
5. Import database (resources/setup-files-db-etc/full-db-structure-2025-09-25.sql)

## Frontend (Laravel mix)
- Where to edit:  uses the files resources/js/main.js and resources/sass/...
- Paths and files for css and js etc defined in webpack.mix.js + config with package.json
- Compile it with: npm run watch / npm run production

## Jobs
To start it locally:
-  `php artisan queue:listen database --tries=1`

## Commands
- `php artisan CarpoolSendUserUpcomingRides:daily`
This runs through a cron job on the server (* * * * * php /data/sites/web/ecomobilisbe/laravelproject/artisan schedule:run)

## How to get streets?
- https://locationiq.com/demo#autocomplete -->  uses open street maps

## JS packages
- Autocomplete js package used for street lookup https://github.com/TarekRaafat/autoComplete.js

## Laravel packages
- https://github.com/msurguy/Honeypot/tree/master
- Laravel ER Diagram Generator

## Laravel livewire
This project uses Laravel Livewire  for reactive components.
Tyical workflow:
Create components with`php artisan make:livewire ExampleComponent`
Components live in app/Http/Livewire/ with corresponding Blade views in resources/views/livewire/.
Use components in Blade templates with:
<livewire:example-component />

# 2. Database

MySQL v5.7
![alt text](graph.png "database ER diagnram")
(Generated with https://github.com/beyondcode/laravel-er-diagram-generator)

Updated are atm not done with migrations but clear sql commands. 
Those can be found in resources/setup-files-db-etc/queries.sql

# 3. Carpool

## Locations
To get locations we use the external Locationiq api. This service uses Open Street Maps and can possible options for streets, city based on a search query.
So it converts a structured or free-form address to geographical coordinates. We screened for fully open and free location services but there are none. LocationIQ seems suited and most clear pricing. 
It can be used for free for a 5000 requests /day and 2 requests / sec.
When a location is submitted we store the coordinates in the db table carpool_street_coordinates to be able to reference to that location.

## Cities autocomplete
The UI for the location selection uses the open source vanilla javascript  library https://github.com/TarekRaafat/autoComplete.js.
We store the json in a hidden field below the input field. It's the hidden field we use in the database.

## Price calculate
When a price is calculated we use the "la distance en bref" + 20%. 
We multiply it with the provided price per km from the user.

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

# 4. API

Docs in /public/readme-api.md or postmen see footer of the application


# 5. Project Structure

Laravel is an advanced MVC framework. The default structure has been followed


# 6. Hosting

The hosting of http://ecomobilis.be/ is at Combell (combell.com). (S)FTP access can be provided, just email dave@telraam.net

# 7. Deployment

Ensure .env is configured for production.

Run:
```
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
npm run build
```

# 8. Design 

## Fonts
DM Sans as main font (https://fonts.google.com/specimen/DM+Sans)
Barlow Condensed for narrow headers (https://fonts.google.com/specimen/Barlow+Condensed)


## 9. GDPR
- we only use essential cookies and do not track any data
- the 
- privacy policy https://ecomobilis.be/page/privacy-policy
- terms and conditions: https://ecomobilis.be/page/terms-of-use
- 
