<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>



## Set up
To set up this project, first clone the repositiory
```bash
$ git clone https://github.com/bputnik/diplomski
```

Change your working directory into the project directory
```bash
$ cd diplomski
```

Then install dependencies using [Composer](https://getcomposer.org/doc/00-intro.md)
```bash
$ composer install
```

Copy `.env.example` to `.env`
```bash
$ cp .env.example .env
```

Delete existing public/storage folder

Create storage link
```bash
php artisan storage:link
```

Create app key
```bash
php artisan key:generate
```

Add a database name into .env
Add following line into .env:
```bash
FILESYSTEM_DRIVER=public
```


## Run
Run the application with the following command
```bash
$ php artisan serve
```
