## About Fitpass
Fitpass is simple single endpoint project. Endpoint checks if User has ability to enter into sports facility and User is then let him enter.

## Requirements
<ul>
<li>PHP >= 7.3</li>
</ul>

## Installation
Install Composer
```
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
```
Run composer install command
```
composer i
```
Create .env folder and copy .env.example into .env file and change database env values accordingly.

Run command for migrations
```
php artisan migrate
```
Run command to seed tables
```
php artisan db:seed
```

## Starting Server
To start server run command
```
php artisan serve
```

## Endpoints
<h3>Api</h3>
/api/checkCanEnterFacility - receives two parameters object_uuid and card_uuid if any of this parameter is missing or no data will be found in database for these parameters validation error will be returned by endpoint. If parameters are correct and there is no entrance data for user success response will be returned.
