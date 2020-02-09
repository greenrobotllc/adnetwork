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

-Configure Amazon S3 image hosting, or other file provider and see the TODO below.

# Requirements

-php 7.2 or greater.

# TODO
-Before you start using this network for real transactions, you'll want to replace the links in the project (SUPPORT CONTACT US BLOG DMCA PRIVACY TERMS) with those of your own.

-Reported bug: There is a problem with seeing images you upload.
The problem is the site is referencing a static S3 bucket URL.

If you search through the code base for "gradnetwork", and make it a configurable variable you should be able to fix the problem.

grep -nr "gradnetwork" *

I would welcome any pull requests fixing this issue, including a pull request for this README.


# FAQ
Question: How to access admin panel? What is login or password?

Answer: First, register as a new user. Then add the uid of the admin user to the ADMIN_ID variable in your .env. Get the uid from the database. Then clear the cache: https://tecadmin.net/clear-cache-laravel-5/

---


Question: How do I display erorrs in development?

Answer: In your .env file, set APP_DEBUG to true.

---

Question: How do I turn off the display of erorrs in production?

Answer: In your .env file, set APP_DEBUG to false.
