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


# FAQ
Question: How to access admin panel? What is login or password?

Answer: First, register as a new user. Then add the uid of the admin user to the ADMIN_ID variable in your .env. Get the uid from the database. Then clear the cache: https://tecadmin.net/clear-cache-laravel-5/
