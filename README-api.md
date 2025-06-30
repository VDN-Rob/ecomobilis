# 0. Internal notes
## TO DO
https://saasykit.com/blog/how-to-generate-documentation-for-your-laravel-project

## 1. Users

### GET open-api/users

### POST open-api/users
````
{    
    "firstname": "Lionel",
    "lastname": "Messi",
    "gender": "M",
    "email": "lionel@test.com",
    "car_id": 123,
}
````
### GET open-api/users/{id}

### PUT open-api/users/{id}}
````
{    
    "firstname": "Matteo",
    "lastname": "Messi",
    "gender": "M",
    "email": "lionel@test.com",
    "car_id": 123,
}
````

## 2. Carpool rides

### GET open-api/carpool-rides

### POST open-api/carpool-rides
````
{
    "travel_start_datetime": "2026-07-12 12:00:00",
    "from_street_coordinates_id": 1,
    "to_street_coordinates_id": 2,
    "luggage_id": 2,
    "seats_available": 3,
    "remark": null,
    "price_per_seat": "10.00",
    "user_id": 1,
    "group_id": null,
    "is_private": 0,
    "is_cancelled": 0
}
````
### GET open-api/carpool-rides/{id}

### PUT open-api/carpool-rides/{id}
````
{
    "travel_start_datetime": "2026-07-12 12:00:00",
    "from_street_coordinates_id": 1,
    "to_street_coordinates_id": 2,
    "luggage_id": 2,
    "seats_available": 3,
    "remark": null,
    "price_per_seat": "10.00",
    "user_id": 1,
    "group_id": null,
    "is_private": 0,
    "is_cancelled": 0
}
````
### DELETE open-api/carpool-rides/{id}
Admin level needed

## 3. Carpool street coordinates
Please use your own implementation of locationiq (https://locationiq.com/) to populate this with put or post

### GET open-api/carpool-street-coordinates

### POST open-api/carpool-street-coordinates
````
{
    "street": "Test Street",
    "zip_code": "5630",
    "city": "Test Stad",
    "country": "Belgium",
    "external_api_id": "321359304323",
    "external_api_source": "locationiq",
    "osm_id": "123456689",
    "osm_way": "way",
    "lat": "50.1700",
    "lng": "4.4000",
    "user_id": 1
}
````

### GET open-api/carpool-street-coordinates/{id}

### PUT open-api/carpool-street-coordinates/{id}
````
{
    "street": "Test Street Update",
    "zip_code": "5630",
    "city": "Test Stad",
    "country": "Belgium",
    "external_api_id": "321359304323",
    "external_api_source": "locationiq",
    "osm_id": "123456689",
    "osm_way": "way",
    "lat": "50.1700",
    "lng": "4.4000",
    "user_id": 1
}
````
### DELETE open-api/carpool-street-coordinates/{id}
Admin level needed

## 4. Carpool ride reservation
### GET open-api/carpool-street-reservations

### POST open-api/carpool-street-reservations/
````
{
    "ride_id": 101,
    "passenger_user_id": 1,
    "amount": 1,
    "is_accepted": 1,
    "is_rejected": 0
}
  ````     

### GET open-api/carpool-street-reservations/{id}

### PUT open-api/carpool-street-reservations/{id}
````
{
    "ride_id": 101,
    "passenger_user_id": 1,
    "amount": 1,
    "is_accepted": 1,
    "is_rejected": 0
}
  ````     

### DELETE open-api/carpool-street-reservations/{id}
Admin level needed

## 5. Carpool car
A car is linked to a user through the car_id in the user table

### GET open-api/carpool-cars

### POST open-api/carpool-cars
You can add it without having the user being attached it. Don't forget to link it afterwards.
````
{
    "car_type_id": 1,
    "brand": "Renault Kangoo",
    "description": null,
    "default_luggage_id": 2,
    "is_smoking_allowed": 0,
    "is_isofix_present": 0,
    "price_per_km_per_seat": "1.10"
}
````
### GET open-api/carpool-cars/{id}

### PUT open-api/carpool-cars/{id}
Check on the id if it's owned by your current user
```` 
{
    "car_type_id": 1,
    "brand": "Renault Kangoo Updated",
    "description": "I have the new version, in red!",
    "default_luggage_id": 2,
    "is_smoking_allowed": 0,
    "is_isofix_present": 0,
    "price_per_km_per_seat": "1.10"
}
  ```` 

### DELETE open-api/carpool-cars/{id}
Admin level needed


## 6. Bike & car sharing


### GET open-api/sharing-org

### POST open-api/sharing-org
user_id should be the one from your key
```` 
 {
    "id": 1,
    "name": "A-bikes!",
    "short_description": "Sed ut perspiciatis unde omnis iste natus error sit",
    "body": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
    "prop_vehicle_car": 0,
    "prop_vehicle_ecar": 0,
    "prop_vehicle_bike": 1,
    "prop_vehicle_ebike": 1,
    "prop_vehicle_cargobike": 0,
    "prop_vehicle_ecargobike": 0,
    "prop_vehicle_step": 0,
    "website": "https://a-bikes.com",
    "email":  "mail@a-bikes.com",
    "payment_subscription_info": "You can subscribe for 30eur/month",
    "user_id": 1
}
  ```` 

### GET open-api/sharing-org/{id}

### PUT open-api/sharing-org/{id}
```` 
 {
    "id": 1,
    "name": "B-bikes!",
    "short_description": "Sed ut perspiciatis unde omnis iste natus error sit",
    "body": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
    "prop_vehicle_car": 0,
    "prop_vehicle_ecar": 0,
    "prop_vehicle_bike": 1,
    "prop_vehicle_ebike": 1,
    "prop_vehicle_cargobike": 0,
    "prop_vehicle_ecargobike": 0,
    "prop_vehicle_step": 0,
    "website": "https://a-bikes.com",
    "email":  "mail@a-bikes.com",
    "payment_subscription_info": "You can subscribe for 30eur/month",
    "user_id": 1
}
  ```` 
