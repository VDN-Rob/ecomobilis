# 0. Internal notes
## TO DO
https://saasykit.com/blog/how-to-generate-documentation-for-your-laravel-project

## 1. Carpool rides

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

### PUT open-api/carpool-rides//{id}
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


## 2. Carpool street coordinates
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
