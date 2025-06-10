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


### Sponsored by GreenRobot LLC

**GreenRobot Sites:**

- [GreenRobot LLC Homepage](https://greenrobot.com) - GreenRobot LLC Homepage
- [Robot Designs](https://robots.greenrobot.com) - Check out thousands of robot designs
- [AI Careers](https://aicareers.greenrobot.com) - Find thousands of Artificial Intelligence and Machine Learning (AI/ML) careers. Updated every few hours with new jobs from VC funded companies.
- [Longevity](https://longevity.greenrobot.com) - Information, research and interactive tools focused on longevity.
- [Launch Day](https://launchday.greenrobot.com) - Get your site ready for launch with this collaborative marketing and tech validation check list.
- [Remote Dev Jobs](https://remotedevjobs.greenrobot.com) - Find thousands of Remote Developer/Engineer jobs. Updated every few hours with new jobs from VC funded companies.
- [Mental Health Lawyers](https://mentalhealthlawyers.greenrobot.com) - Directory of Mental Health Lawyers in the USA for involuntary commitment and guardianship issues.
- [3D Web Games](https://3dwebgames.com) - Discover 3D web games in this curated directory in the style of a video game store/Blockbuster.
- [3D Tank Game](https://3dtankgame.com) - Fun free tank survival game. No login or app required.
- [Cartoonify](https://cartoonify.greenrobot.com) - Turn Yourself Into A Cartoon for Free.
- [Job Search](https://jobsearch.greenrobot.com) - Discover jobs at portfolio companies backed by Venture Capitalists
- [Wizard Writer](https://wizardwriter.greenrobot.com) - Automatically write blog posts


