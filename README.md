<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## About FB mini API

This is a simple onboarding API that contains the following endpoint:

### AUTH
- POST: [domain_name]/api/v1/register
- POST: [domain_name]/api/v1/login

## POST
- GET: [domain_name]/api/v1/post
- GET: [domain_name]/api/v1/post/{id}
- DELETE: [domain_name]/api/v1/post/{id}
- PUT: [domain_name]/api/v1/post/{id}
- POST: [domain_name]/api/v1/post

### COMMENT
- GET: [domain_name]/api/v1/comment
- GET: [domain_name]/api/v1/comment/{id}
- DELETE: [domain_name]/api/v1/comment/{id}
- PUT: [domain_name]/api/v1/comment/{id}
- POST: [domain_name]/api/v1/comment

## # Installation

### How to install Laravel Passport?

$ composer require laravel/passport

$ php artisan migrate

$ php artisan passport:install

Please check the [Laravel Passport](https://laravel.com/docs/9.x/passport) link for more info. 

### Postman Collection
Please check the postman collection [Postman Collection](https://www.getpostman.com/collections/974a5d21a9d0c0f221c9)
