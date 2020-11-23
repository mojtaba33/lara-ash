**First, I have to say that I did not design the HTML template for this project**
## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)

Alternative installation is possible without local dependencies relying on [Docker](#docker). 

Clone the repository

    git clone https://github.com/mojtaba33/lara-ash.git laravel

Switch to the repo folder

    cd laravel

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env  (Set the database connection in .env)


Install all the dependencies using composer

    composer install


Generate a new application key

    php artisan key:generate


Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Fill the database with fake information

    php artisan db:seed

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

**TL;DR command list**
