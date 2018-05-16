# Laravel Framework 5.5, Sentinel, Datatables
## Starter Site based on on Laravel 5.5
* [Features](#feature1)
* [Requirements](#feature2)
* [How to install](#feature3)
* [Troubleshooting](#feature5)
* [Need a UI?](#feature6)
* [License](#feature7)
* [Additional information](#feature8)

<a name="feature1"></a>
## Features:
* Laravel 5.5.x
* Back-End
    * Dashboard.
    * Role management
    * User management
* Front-end
    * User Login
    * User Registration
    * User Activation
    * User Forgot Password
    * User Change Password
* Packages included:
	* Sentinel
	* AdminLTE-2.4.3
	* Datatables Bundle
-----
<a name="feature2"></a>
## Requirements

	PHP >= 7.0.0
	OpenSSL PHP Extension
	PDO PHP Extension
	Mbstring PHP Extension
	Tokenizer PHP Extension
	XML PHP Extension
-----
<a name="feature3"></a>
## How to install:

* [Step 1: Get the code](#step1)
* [Step 2: Use Composer to install dependencies](#step2)
* [Step 3: Create database](#step3)
* [Step 4: Install](#step4)
* [Step 5: Start Page](#step5)
-----
<a name="step1"></a>
### Step 1: Get the code - Download the repository

	https://github.com/mabuak/laravel-sentinel-example/archive/master.zip 
    
    OR Clone this repository:
     https://github.com/mabuak/laravel-sentinel-example.git

Extract it in www(or htdocs if you using XAMPP or MAMP) folder and put it for example in sentinel-example folder.

<a name="step2"></a>
### Step 2: Use Composer to install dependencies

Laravel utilizes [Composer](http://getcomposer.org/) to manage its dependencies. First, download a copy of the composer.phar.
Once you have the PHAR archive, you can either keep it in your local project directory or move to
usr/local/bin to use it globally on your system.
On Windows, you can use the Composer [Windows installer](https://getcomposer.org/Composer-Setup.exe).
Open terminal and go to the project foleder
Then run:

    composer dump-autoload
    composer install --no-scripts

<a name="step3"></a>
### Step 3: Create database

If you finished first three steps, now you can create database on your database server(MySQL). You must create database
with utf-8 collation(uft8_general_ci), to install and application work perfectly.
Just go to the phpmyadmin and create the new database
After that, copy .env.example and rename it as .env and put connection and change default database connection name, only database connection, put name database, database username and password.

<a name="step4"></a>
### Step 4: Install

Now that you have the environment configured, you need to create a database configuration for it. For create database tables use this command:

    php artisan migrate

And to initial populate database use this:

    php artisan db:seed

If you install on your localhost in folder sentinel-example, you can type on web browser:

	http://localhost/sentinel-example/public

OR Run the command " php artisan serve ", and open on the browser the url you get in console :):

<a name="step5"></a>
### Step 5: Start Page

You can now login to admin part of Laravel Framework 5.5  Site:

    username: admin@admin.com
    password: password
    
<a name="feature5"></a>
## Troubleshooting

### RuntimeException : No supported encrypter found. The cipher and / or key length are invalid.

    php artisan key:generate

### Site loading very slow

	composer dump-autoload --optimize
OR

    php artisan dump-autoload

### Don't forgot to add your smtp_email in .env file
    
    If you don't have smtp access, you can comment the code in AuthController in line 128 and 229, and uncomment line 133 and line 234

<a name="feature6"></a>
## Need a UI?

The package doesn't come with any screens out of the box, you should build that yourself. 
To get started check out this [demo link](https://sentinel-example.dhanhost.com)

<a name="feature7"></a>
## License

This is free software distributed under the terms of the MIT license

<a name="feature8"></a>
## Additional information

Inspired by Laravel 5.5 and based on:
[AdminLTE Dashboard](https://github.com/almasaeed2010/AdminLTE)
[Sentinel Authentication](https://cartalyst.com/manual/sentinel/2.0)
[Laravel Datatables](https://github.com/yajra/laravel-datatables)
[laravel-sentinel-crud-starter](https://github.com/roladn/laravel-sentinel-crud-starter)

