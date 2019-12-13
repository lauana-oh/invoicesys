## About InvoiceSys

InvoiceSys is a web application to invoice control system that incorporates all the requirements contained in the trade code of Colombian's law

## Starting InvoiceSys

- **Clone GitHub repo for this project locally:**
    Find a location on your computer where you want to store the project.
    You want to do it in the folder display of your server side application. (htdocs for xampp, www for laragon and wamp, etc).
    
    In this folder you can clone and access it with the following command lines:
    
        git clone https://github.com/lau-hubler/invoicesys.git
        cd invoicesys
    

- **Install Composer Dependencies:**
    Whenever you clone a new Laravel project you must now install all of the project dependencies.
    So to install all this source code we run composer with the following command.
    
        composer install
        

- **Install NPM Dependencies:**
    Just like how we must install composer packages to move forward, we must also install necessary NPM packages to move forward.
    To do that, you can run the following command:
    
        npm install
    

- **Create a copy of your .env file:**
    For security reasons, we expect you to make a copy of the .env.example file and create a .env file that you can start to fill out with your database configuration in the next few steps.
    You can do it by entering the following command line:
    
        cp .env.example .env
    

- **Generate an app encryption key:**
    Laravel, our framework used, requires you to have an app encryption key which is generally randomly generated and stored in your .env file. The app will use this encryption key to encode various elements of your application from cookies to password hashes and more.
    In the terminal we can run this command to generate that key:
    
        php artisan key:generate
        

- **Create an empty database for our application:**
    Create an empty database for your project using the database tools you prefer.
    As example, you can do it in the terminal using MySQL:
    
        mysql -u root
        
    Then, once you are in mysql space, enter:
    
        create database invoicesys;
        exit
    
- **Migrate and seed the database:**
    Now you can migrate your database and run the seeding files setup:
    
        php artisan migrate --seed
    
**All done! You are ready to start with your InvoiceSys.**