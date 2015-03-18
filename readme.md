## Laravel 4 Example Application

This is a laravel example application, it includes “crud” actions for recipes, user authentication, validation, user roles, migrations, seeding, sending e-mails and way more. Enough talk, lets get you started discovering this application! 

## Installation Instructions

Installation of an application build on the laravel framework is easy as pie! First we need somekind of local server envoirment, if you will be working with Laravel i recommend using homestead. It got all the things you need in a prepackaged vagrant box, awesome! 

You can find more information about homestead here: http://laravel.com/docs/4.2/homestead

Let's assume you got thing up and running and get on with the installation.

Step 1:

First clone this repository to a directory:
„git clone https://github.com/rofavadeka/recipes.git”
- Or -
Download the zip and extract it 


Step 2:

Next we are going to install the required dependencies using composer. Make sure you have composer installed. Open up terminal and go to the project folder. Run composer update to update all required dependencies by typing:
"composer update"

Step 3:

Now we need a database to store things like users or recipes. Change „app/config/database.php” and replace the values with your database details.

Step 4:

Configure your email settings. For the mail part to work we need to configure your email settings. You can do this by changing the correct values within „app/config/mail.php”, make sure you also set pretend to false. ( 'pretend' => false, )

Step 5: 

Let's create our database structure and add some records to get you started. Laravel takes care of this for you! All you have to do is type two simple commands within your terminal. So open up terminal and go to your project folder. Next type in:

„php artisan migrate”

This will create the structure of your database according to the files within „app/database/migrations/”. Now we need to add some records. This is called seeding and happens according to the files within „app/database/seeds/”. Typ in:

„php artisan db:seed”

Step 6:

Open your webbrowser, visit your webserver ( http://localhost:port/ ) and everything should work.

A full documentation can be found on their official website: http://laravel.com/docs/4.2 

## Laravel PHP Framework

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, and caching.

Laravel aims to make the development process a pleasing one for the developer without sacrificing application functionality. Happy developers make the best code. To this end, we've attempted to combine the very best of what we have seen in other web frameworks, including frameworks implemented in other languages, such as Ruby on Rails, ASP.NET MVC, and Sinatra.

Laravel is accessible, yet powerful, providing powerful tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

