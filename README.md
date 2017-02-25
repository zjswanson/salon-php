# _Salon Manager_

#### _Application to demonstrate database interaction with mysql and php.  Created February 2017._

#### By _**Zach Swanson**_

## Description

_This is a simple application designed to demonstrate interaction with a mysql database using php.  The application is a utility for a salon manager to organize the stylists they employ, along with those stylist's client lists.  The app will communicate with a mysql database and allow all basic CRUD functionality across two tables of records._

## Application Behaviors
```
Behavior: On Stylist List, User inputs new stylist info and clicks create new stylist, app displays the stylist in the stylist list:
Sample Input: "Eduardo, Pompadour"
Sample Output: Stylist entry is displayed with a name of Eduardo and specialty of Pompadour
```
```
Behavior: On Stylist List, User clicks Delete all Stylists, app deletes stylists and displays empty list
Sample Input: clicks delete all stylists
Sample Output: Stylist list is empty
```
```
Behavior: On Stylist List, User clicks edit stylist list under a stylist, app navigates to stylist's client list
Sample Input: clicks edit stylist list
Sample Output: app navigates to edit stylist page for that stylist
```
```
Behavior: On Edit Stylist, User clicks back to stylist List, app navigates to stylist list
Sample Input: User clicks back to stylist List
Sample Output: app navigates back to stylist List
```
```
Behavior: On Edit Stylist, User inputs new stylist name and/or new specialty, clicks update stylist, app changes and display's stylist's entry
Sample Input: User inputs "Mrs dude, Really big hair"
Sample Output: app updates stylist name to Mrs. Dude, specialty to Really big hair.
```
```
Behavior: On Edit Stylist, User clicks To Client List, app navigates to client list
Sample Input: User clicks back to client List
Sample Output: app navigates back to client List
```
```
Behavior: On Edit Stylist, User clicks Delete Stylist, app deletes stylist and navigates to stylist list.
Sample Input: User clicks delete stylist
Sample Output: app navigates stylist list, displays list (without deleted stylist)
```
```
Behavior: On Stylist List, User clicks view client list under a stylist, app navigates to stylist's client list
Sample Input: clicks view client list
Sample Output: app navigates to client list page for that stylist
```
```
Behavior: On Client List, User inputs new client info and clicks create new client, app displays the client in the client list:
Sample Input: "Mr. Dude, Fri, Feb 17 3:00 PM"
Sample Output: Client entry is displayed with a name of Mr. Dude and appointment of Fri, Feb 17 3:00 PM
```
```
Behavior: On Client List, User clicks back to stylist List, app navigates to stylist list
Sample Input: User clicks back to stylist List
Sample Output: app navigates back to stylist List
```
```
Behavior: On Client List, User clicks Edit Client, app navigates to Edit Client page
Sample Input: User clicks back to stylist List
Sample Output: app navigates back to stylist List
```
```
Behavior: On Client, User clicks Edit Client, app navigates to Edit Client page
Sample Input: User clicks back to stylist List
Sample Output: app navigates back to stylist List
```
```
Behavior: On Edit Client, User clicks To Client List, app navigates to Stylist's client list
Sample Input: User clicks back to client List
Sample Output: app navigates to client's Stylist's Client List
```
```
Behavior: On Edit Client, User clicks go to stylist List, app navigates to stylist list
Sample Input: User clicks back to stylist List
Sample Output: app navigates back to stylist List
```
```
Behavior: On Edit Client, User inputs new client name and/or new appointment, clicks update client, app changes and display's client's entry
Sample Input: User inputs "Mrs dude, Fri, Feb 17 3:02 PM"
Sample Output: app updates client name to Mrs. Dude, appointment to Fri, Feb 17 3:02 PM".
```
```
Behavior: On Edit Client, User clicks Delete Client, app deletes client and navigates to client list.
Sample Input: User clicks delete client
Sample Output: app navigates client list, displays list (without deleted client)
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

 _No current method to escape data being sent to database, so inputs containing special characters (i.e. "Zach's") may cause failure to write to database.  Also, no protection against SQL injection, so someone may steal my imaginary hair salon data :)_

## Support and contact details

_Created by Zach Swanson, zach.j.swanson@gmail.com.  No ongoing support planned, but questions or comments are welcome._

## Technologies Used

_Written in Atom text editor, using PHP, Silex, and Twig.  Tested functionality with PHPUnit and user interface on a local server with MAMP._

### License

*MIT license*

Copyright (c) 2017 **_Zach Swanson_**
