# D4SD Backend
<a href="https://travis-ci.org/creativecolab/civicchallenge-backend"><img src="https://travis-ci.org/creativecolab/civicchallenge-backend.svg" alt="Build Status"></a>

Backend for [Design 4 San Diego](https://designsandigo.ucsd.edu).

---

## Quickstart
```
mv .env.example .env
composer install
npm install && npm run production
php artisan migrate
php artisan serve
```

## Requirements

* PHP
* Composer
* NodeJS + npm

### Installing NodeJS & NPM

If you don't already have node and npm installed, visit [the node website](http://nodejs.org/) to download and install the proper package. npm comes standard with node as a package so no need to install it separately.

Using [nvm](https://github.com/creationix/nvm) is recommended to help manage node versions.

### Installing npm packages

Use this command to install the required packages:

`npm install`

### Installing PHP dependencies

Use this command to install the required PHP packages:

`composer install`

### Development Environment

Using [Laravel Valet](https://laravel.com/docs/5.4/valet) is recommended to make your life easier. 

---

## Installation

### Set up your environment variables
`mv .env.example .env`

Edit the values in `.env` with your local values.

### Install packages
`composer install` - Install PHP packages

`npm install` - Install node packages for frontend build

### Migrate
`php artisan migrate`

### Build assets
**For development**

`npm run dev`

**For production**

`npm run prod`

### Server
If you're not using [Laravel Valet](https://laravel.com/docs/5.4/valet), configure the `public` folder to be your document root.

You can also use Laravel's built-in server (not highly recommended):

`php artisan server`

This will allow you to access the server at `127.0.0.1:8000`.

---

## Testing

This project is using Travis CI to check builds. Builds will be checked when commits are pushed.

**Run tests**

`phpunit`
