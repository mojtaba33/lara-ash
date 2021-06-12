**First, I have to say that I did not design the HTML template for this project**

## Installation

  

Go to this link for live preview : [ashion](http://laravelo.herokuapp.com)


Clone the repository

  

    git clone https://github.com/mojtaba33/lara-ash.git laravel

  

Switch to the repo folder

  

    cd laravel

  

Copy the example env file and make the required configuration changes in the .env file

  

    cp .env.example .env (Set the database connection in .env)

  
  

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

  

You can now access the server at **http://127.0.0.1:8000** and You can login with **email:admin@admin.com** and **password:12345678** as administrator
