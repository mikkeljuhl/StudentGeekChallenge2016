# STUDENT GEEK CHALLENGE 2016
Received 1st place for this solution to the Geek Challenge @ Novicell.

The git repository is obviously very cluttered (a lot of dependencies that does not need to be present) 

# README #
I have chosen to create a small e-commerce platform using Laravel. At the time of writing, it contains 15 products.

The website can be reached at ~~http://sgc.mikkeljuhl.com}~~.

## Some key features
* Facebook login (Go to login / register and then click "FB Login")
	* Doesn't work since I have deleted the app 
* Products
	* One product image
	* Product description
	* Price
	* Buy
* Categories
* Attribute relations
	* I.e. "size", "color" etc.
	* One to many relation (one attribute relation has many attributes)
* Attributes
	* Substructure of Attribute relations, example for color, would be "White"
	* One to one relation
* Basket
* Account overview
* Order overview
* Shipping methods
* Search
	* If only one result: goes directly to that product \textbf{(try: table)}
	* If more than one show result page \textbf{(try: cabinet)}

Logging in as an admin you get access to the "Admin Area" menu which handles creation, edit. To edit a product or category one has to be logged in as an admin and go the overview of either products or categories and then click the "Edit" link. This edit link is not present unless you are logged in as an admin.

## Basic explanation of Laravel code structure

Laravel is based upon the Model-View-Controller design pattern. So there are three main places to look for code.

- app/Http/Controllers/ where all the controllers are based.
- app/*.php where all the models are based. These are not that interesting since a lot of the logic i handled by the parent class "Model" which each model extends.
- resources/views where all the views are located. These are written using the Blade framework, to make it easier to read.

Furthermore, bootstrap is used as a theme framework.

## Running a local instance of the application

Assuming UNIX operating system and some dependencies such as composer.

* composer update
* touch database/database.sqlite
* vim .env (see below if empty)
* php artisan key:generate
* php artisan config:clear
* php artisan migrate
* php artisan serve

This gives you an instance of the application. Register a user.

Then
```
$ cd database/
$ sqlite3
$ .open database.sqlite
$ UPDATE users set role = "a" WHERE id = 1
```
This gives the created user admin rights (assuming it is the first user registered. After this the webshop works as is -- you just need to create a shipping method, products and optionally categories, attributes and so on :-).

```
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_LOG_LEVEL=debug
APP_URL=http://localhost:8000

BROADCAST_DRIVER=log
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=mailtrap.io
MAIL_PORT=2525php
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
```
