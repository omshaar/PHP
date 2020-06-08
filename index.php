<!DOCTYPE html>
<?php 
include('Bais.php');
?>

<html class="no-js">
 
  <head>
    <meta charset="utf-8">
  
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic" rel="stylesheet">
    <link href="styles/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
  </head>
  <body>
    <header class="header navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="row">
          <div class="navbar-header">
            <button type="button" data-toggle="collapse" data-target="#navbar-collapse-1" class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a href="#" class="navbar-brand">REST API For Products Catalog</a>
          </div>
          <div id="navbar-collapse-1" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
            <li><a href='<?php echo $_SESSION["bais"]?>db_operations/setup_database.php'>Install database</a></li>
              <li><a href="#home">Note</a></li>
              <li><a href="#setup">Setup</a></li>
              <li><a href="#urls">URLs</a></li>
              
              <li><a href="#assumptions">Assumptions</a></li>
              <li><a href="#deployment">Deployment</a></li>
              <li><a href="#time">Time frame</a></li>
              <li><a href='<?php echo $_SESSION["bais"]?>Login.php'>Login</a></li>
              <li><a href='<?php echo $_SESSION["bais"]?>createUser.php'>Create User</a></li>
            </ul>
          </div>
        </div>
      </div>
    </header>
    <div class="main-content">
      <div class="banner">
        <div class="container" style="padding-bottom:40px;">
          <h2>RESTful API for products catalog .</h2>
          <p style="font-size:16px;">This is a simple and basic  REST api for Product catalog. This provides basic authentication and REST api's for CRUD operations</p>
          <p style="font-size:16px;">The API is written in PHP and MySQL</p>
        </div>
      </div>
      <div id="setup" class="features">
        <header>
          <h3 class="text-center">Deployment requirements</h3>
        </header>
        <div class="container">
          <div class="row">
            <div class="feature-item col-md-12">
              <h3>Server</h3>
              <div>
                <p>
                  apache server with php version more than 7.2 or any web server with the same php version</p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="feature-item col-md-12 ">
              <h3>Database</h3>
              <div>
                <p>The code assumes MySQL as server.</p>
               
              </div>
            </div>
          </div>
        </div>
      </div>

      <div id="urls" class="features">
        <header>
          <h3 class="text-center">URls</h3>
          <h4 class="text-center">Following are the urls defined for the api and their description</h4>
        </header>
        <div class="container">
          <div class="row">
            <div class="feature-item col-md-12">
              <h3>Account</h3>
              <div>
                <p>/api/login-api.php [POST]: Login for the api. It requires two $_POST params, . 'username' and 'password' </p>
                <p>/api/create_user_api.php [POST]: create new user. needed params: 'first_name', 'last_name','username','password','email'.</p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="feature-item col-md-12 ">
              <h3>Product</h3>
              <div>
                <p>/api/product_api.php/{id} [POST]: Returns the details for the product with given id.</p>
                <p>/api/product_api.php [GET]: Returns the list of all products.</p>
                <p>/api/product_api.php [POST]: Adds a new product to the database. It requires  $_POST params as 'name' and 'price','description','list of categories ides like [1,2,5]'.</p>
                <p>/api/product_api.php/{id} [PUT]: Updates the product with the given id. require params as create product api</p>
                <p>/api/product_api/{id} [DELETE]: Removes the product from the database</p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="feature-item col-md-12 ">
              <h3>Category</h3>
              <div>
                <p>/api/category_api.php/{id} [POST]: Returns the details for the category with given id.</p>
                <p>/api/category_api.php [GET]: Returns the list of all category.</p>
                <p>/api/category_api.php [POST]: Adds a new category to the database. It requires  $_POST params as 'name' and,'description'</p>
                <p>/api/category_api.php/{id} [PUT]: Updates the category with the given id. require params as create category api</p>
                <p>/api/category_api/{id} [DELETE]: Removes the category from the database</p>
              </div>
            </div>
          </div>
        </div>
      </div>

     

      <div id="assumptions" class="features">
        <header>
          <h3 class="text-center">Assumptions</h3>
          <h4 class="text-center">Following are the assumptions made while developing this api.</h4>
        </header>
        <div class="container">
          <div class="row">
            <div class="feature-item col-md-12">
              <div>
                <p> No framework was used while building this API</p>
                <p> The bakcend is written purely in PHP</p>
                <p> The database is MySQL, so it is assumed to be on the system</p>
                <p> The unique ids of the products and categories are assumed to be numeric (AUTO-INCREMENT)</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="deployment" class="features">
        <header>
          <h3 class="text-center">Deployment</h3>
        </header>
        <div class="container">
          <div class="row">
            <div class="feature-item col-md-12">
              <div>
                <p> - First you naeed to prepare the envronment as Deployement requirements.</p>
                <p> if you dont wont to install the apove requirements, I have prepered docker-compose file contains all the necessary containers to run the application, so feel free to install the containers 
and run the application.</p>
                <p> Note that the images I used in the docker file using Nginx as web server, and the mysql as database server.</p>
                <p> the reason I used Nginx as web server is to test the application on both apache and Nginx.</p>
                <p> If you use the Nginx server as from my docker-compose file you must place the project inside folder named src inside public folder.</p>
                <p> if you use apache place the project inside any named folder inside htdocs folder.</p>
                <p>After that you have to configure DatabaseService.php file located under db_operations folder with the following information:</p>
                <p>- $db_host: the host name for your database example :localhost.</p>
                <p> $db_name: the database name.</p>
                <p> $db_user: the user for the database.</p>
                <p> $db_password: the password for the user.   </p>
                <p> After that run install database from the home page. </p>
                <p> you can now start by create a new user. and login to start test the application </p>

              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="time" class="features">
        <header>
          <h3 class="text-center">TIME FRAME</h3>
        </header>
        <div class="container">
          <div class="row">
            <div class="feature-item col-md-12">
              <div>
               <table style="width: 100%;">
                 <tr>
                   <td>
                   Task Name
                   </td>
                   <td>
                   Time spent
                   </td>
                 </tr>
                 <tr>
                   <td>
                   prepare envronment
                   </td>
                   <td>
                   4 hours
                   </td>
                 </tr>
                 <tr>
                   <td>
                   create database with required php files 
                   </td>
                   <td>
                   6 hours
                   </td>
                 </tr>
                 <tr>
                   <td>
                   create api files (models and controllers)
                   </td>
                   <td>
                   9 hours
                   </td>
                 </tr>
                 <tr>
                   <td>
                   create views files 
                   </td>
                   <td>
                   8 hours
                   </td>
                 </tr>
                 <tr>
                   <td>
                   documentaion
                   </td>
                   <td>
                   4 hours
                   </td>
                 </tr>
                 <tr>
                   <td>
                   tasting
                   </td>
                   <td>
                   4 hours
                   </td>
                 </tr>
               </table>

              </div>
            </div>
          </div>
        </div>
      </div>



    </div>
    <footer class="footer text-center"> this project for testing purposes</footer>
  
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="scripts/jquery.min.js"><\/script>')</script>
    <script src="scripts/bootstrap.min.js"></script>
    <script src="scripts/jquery.smooth-scroll.min.js"></script>
    <script src="scripts/main.js"></script>
  </body>
</html>