# adnetwork
Liberty Ad Network
![Screenshot 1](https://github.com/greenrobotllc/adnetwork/blob/master/sampleimages/image1.png)
![Screenshot 2](https://github.com/greenrobotllc/adnetwork/blob/master/sampleimages/image2.png)


# How to install

-Run:
cp .env.sample .env

-Run:
nano .env

-Edit the .env file as needed

-Run: 
php artisan key:generate


-Run:
php composer.phar install

# Requirements

-php 7.2 or greater.

# FAQ
Question: How to access admin panel? What is login or password?

Answer: First, register as a new user. Then add the uid of the admin user to the ADMIN_ID variable in your .env. Get the uid from the database. Then clear the cache: https://tecadmin.net/clear-cache-laravel-5/


Question: How do I display erorrs in development?

Answer: In your .env file, set APP_DEBUG to true.


Question: How do I turn off the display of erorrs in production?

Answer: In your .env file, set APP_DEBUG to false.
