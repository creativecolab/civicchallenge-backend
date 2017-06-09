# D4SD Backend
<a href="https://travis-ci.org/creativecolab/civicchallenge-backend"><img src="https://travis-ci.org/creativecolab/civicchallenge-backend.svg" alt="Build Status"></a>

Backend for [Design 4 San Diego](https://designsandigo.ucsd.edu).

---

## Quickstart
```
cp .env.example .env
composer install
npm install && npm run production
php artisan migrate
php artisan serve
```

## Requirements

* PHP
* Composer
* NodeJS + npm
* MySQL

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

### Composer

On macOS, make sure you have [Homebrew](http://brew.sh/) installed.

```
brew update
brew tap homebrew/dupes
brew tap homebrew/php
brew install php71
brew install composer
```

Make sure to place the `~/.composer/vendor/bin directory` in your PATH

### Development Web Server

Choose one method:

#### Laravel Valet (Highly Recommended)

> If you're using macOS, using [Laravel Valet](https://laravel.com/docs/5.4/valet) is highly recommended.

##### Quickstart

Make sure you have [Homebrew](http://brew.sh/) installed.

```
brew install
brew update
brew install homebrew/php/php71
composer global require laravel/valet
```

#### PHP Development Server
You can use Laravel's built-in server but it's not highly recommended:

`php artisan server`

This will allow you to access the server at `127.0.0.1:8000`.


#### Other servers
If you're using another web server (nginx, apache, etc.) configure the `public` folder to be your document root.


### MySQL
If you don't have MySQL already.

```
brew install mysql
```

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

---

## [API Documentation](http://creativecolab.github.io/civicchallenge-backend)

`npm run docs` - Generate `docs/index.html`

`npm run docs:serve` - Serve docs at `http://localhost:3000`

---

## Testing

This project is using Travis CI to check builds. Builds will be checked when commits are pushed.

**Run tests**

`phpunit`
