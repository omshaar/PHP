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
    <link href="styles/toastr.css" rel="stylesheet">
    <link href="styles/select2.min.css" rel="stylesheet">
    <link href="styles/select2-bootstrap.css" rel="stylesheet">
    <style>
      
      </style>
  </head>
  <body>
    <header class="header navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="row">
          <div class="navbar-header">
            <button type="button" data-toggle="collapse" data-target="#navbar-collapse-1" class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a href="#" class="navbar-brand">REST API</a>
          </div>
          <div id="navbar-collapse-1" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
              <li><a href='<?php echo $_SESSION["bais"]?>Products.php'>Products</a></li>
              <li><a href='<?php echo $_SESSION["bais"]?>Categories.php'>Categories</a></li>
            </ul>
          </div>
        </div>
      </div>
    </header>