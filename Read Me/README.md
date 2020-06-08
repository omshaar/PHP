RESTful-API-PHP with client 
===============

NOTE: This project is build for testing purposes to get avery important job.
- The api can handl all sorts of clients (mobile application, web application ...etc)
- The project built using pure php without using any framework as recommended.
- Restfull api is used to handel server side requists.so the response is in Json format.

Application Functions
----------------------------

This Application contains the follwoing functions:
- Create new users.
- Login to application.
- View all products.
- Filter products by product category
- Edit product
- Delete product
- Create new product
- Access control only for authenticated users
- Add new product category
- Edit product category
- Delete product category

Deployment requirements
----------------------------

Server
apache server with php version more than 7.2 or any web server with the same php version

Database
MySQL version 5.7.29 or higher as database server. 

composer for downloading missing package.

installed package is:
-firebase/php-jwt ^5.2 //this package used to formulate encrypted access token using Json Web Token (jwt) methods 


Deployment instructions
----------------------------
- First you naeed to prepare the envronment as Deployement requirements.
if you dont wont to install the apove requirements, I have prepered docker-compose file contains all the necessary containers to run the application, so feel free to install the containers 
and run the application.
- Note that the images I used in the docker file using Nginx as web server, and the mysql as database server.
- the reason I used Nginx as web server is to test the application on both apache and Nginx.
- If you use the Nginx server as from my docker-compose file you must place the project inside folder named src inside public folder. 
- if you use apache place the project inside any named folder inside htdocs folder.
After that you have to configure DatabaseService.php file located under db_operations folder with the following information:
- $db_host: the host name for your database example :localhost.
- $db_name: the database name.
- $db_user: the user for the database.
- $db_password: the password for the user.   

After that run install database from the home page.
- you can now start by create a new user. and login to start test the application




URLs
--------------
Following are the Urls defined for the api and their description


Account
/api/login-api.php [POST]: Login for the api. It requires two $_POST params, . 'username' and 'password'

/api/create_user_api.php [POST]: create new user. needed params: 'first_name', 'last_name','username','password','email'.

Product
/api/product_api.php/{id} [POST]: Returns the details for the product with given id.

/api/product_api.php [GET]: Returns the list of all products.

/api/product_api.php [POST]: Adds a new product to the database. It requires  $_POST params as 'name' and 'price','description','list of categories ides like [1,2,5]'.

/api/product_api.php/{id} [PUT]: Updates the product with the given id. require params as create product api

/api/product_api/{id} [DELETE]: Removes the product from the database

Category

/api/category_api.php/{id} [POST]: Returns the details for the category with given id.

/api/category_api.php [GET]: Returns the list of all category.

/api/category_api.php [POST]: Adds a new category to the database. It requires  $_POST params as 'name' and,'description'

/api/category_api.php/{id} [PUT]: Updates the category with the given id. require params as create category api

/api/category_api/{id} [DELETE]: Removes the category from the database
ASSUMPTIONS
---------------
Following are the assumptions made while developing this api.

No framework was used while building this API

The bakcend is written purely in PHP

The database is MySQL, so it is assumed to be on the system

The unique ids of the items are assumed to be numeric (AUTO-INCREMENT)


TIME FRAME
---------------
Task Name																Time spent

prepare envronment														4 hours
create database with required php files 								6 hours
create api files (models and controllers)								9 hours
create views files 														8 hours
documentaion															4 hours
testing																	4 hours