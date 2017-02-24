# _Salon Manager_

#### _Application to demonstrate database interaction with mysql and php.  Created February 2017._

#### By _**Zach Swanson**_

## Description

_This is a simple application designed to demonstrate interaction with a mysql database using php.  The application is a utility for a salon manager to organize the stylists they employ, along with those stylist's client lists.  The app will communicate with a mysql database and allow all basic CRUD functionality across two tables of records._

## Application Behaviors
```
Behavior: User inputs a search string and a phrase string to be searched.  App outputs the number of occurrences of the search string in the phrase string.
Sample Input: search: "cat", "The internet loves the cat.  Cat videos, cat merchandise, cat apparel and catalogs of cat behavior."
Sample Output: 5 matches.
Testing method: The phrase was chosen because the search string occurs many times, and because the search string is contained in another word in the phrase.  Verifying functionality will require testing that the method 1)returns a match for a single occurrence of the search string, 2)returns the correct number of matches for multiple occurrences, and 3) does not return a match for partial word matches.
```





## Setup/Installation Requirements

* This application requires the Silex framework and Twig templating engine, as well as the Composer dependency manager.  Unit testing was done with with the PHPUnit framework.  The applicaiton is designed to work with a mysql database using a PHP PDO object.   
* To install, make sure that you have composer installed (https://getcomposer.org/), clone this repository from github, and run "composer install" from the project directory in terminal.  This will install the required dependencies in the project directory.
* To configure the database, either import the zipped database  contents from the "data" folder into your mysql database or manually create databases (production and test) to mirror their structure.  Directions for manual creation on a MAMP server using mySQL and Apache are below.
* To run the application, you will need to run a local server running php in the "web" folder of the project directory (Application was tested using MAMP: https://www.mamp.info/en/.  Then direct any browser to your local server to run.
* To replicate testing, navigate to the project directory in terminal (after composer install) and run the command "./vendor/bin/phpunit tests".  The specific tests may be viewed in ./tests/.


* Database configuration:
* Launch MAMP and start servers, then run /Applications/MAMP/Library/bin/mysql --host=localhost -u(username) -p(password) in the command line, then enter the following commands:
* CREATE DATABASE hair_salon;
* USE hair_salon;
* CREATE TABLE stylists (id serial PRIMARY KEY, stylist_name VARCHAR (255),specialty VARCHAR(255));
* CREATE TABLE clients (id serial PRIMARY KEY, client_name VARCHAR(255), next_appointment DATETIME, stylist_id BIGINT(20));
* Then use MAMP'S myphpadmin to copy the structure of this database into another called hair_salon_test.  The PHPUnit testing suite will use this database when you replicate the unit tests.


## Known Bugs

 _No known bugs.  Modest functionality at best, but it isn't buggy._

## Support and contact details

_Created by Zach Swanson, zach.j.swanson@gmail.com.  No ongoing support planned, but questions or comments are welcome._

## Technologies Used

_Written in Atom text editor, using PHP, Silex, and Twig.  Tested functionality with PHPUnit and user interface on a local server with MAMP._

### License

*MIT license*

Copyright (c) 2017 **_Zach Swanson_**
