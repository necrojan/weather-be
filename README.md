## Weather BE

A laravel backend for a weather app. 

### Installation
This is being run in Laravel valet for an easy installation.

```
git clone https://github.com/necrojan/weather-be
cd to weather-be && composer install
cp .env.example .env

OPEN_WEATHER_BASE_URL=
OPEN_WEATHER_MAP_API_KEY=

FOURSQUARE_BASE_URL=
FOURSQUARE_API_KEY=
```

The app uses Openweather and Foursquare api's so make sure to
sign up to those and get the api keys.


## Test
`php artisan test`
