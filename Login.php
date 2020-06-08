<!DOCTYPE html>
<?php 
include('Bais.php');
?>
<!--if lt IE 8html.no-js.lt-ie8
-->
<!--[if gt IE 8]><!-->
<html class="no-js">
  <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <!-- if IEmeta(http-equiv='X-UA-Compatible', content='IE=edge,chrome=1')
    -->
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic" rel="stylesheet">
    <link href="styles/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="styles/toastr.css" rel="stylesheet">
    <link href="styles/select2.min.css" rel="stylesheet">
    <link href="styles/select2-bootstrap.css" rel="stylesheet">
  </head>
  <body>
    <header class="header navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="row">
          <div class="navbar-header">
            <button type="button" data-toggle="collapse" data-target="#navbar-collapse-1" class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a href='<?php echo $_SESSION["bais"]?>index.php'class="navbar-brand">Home Page</a>
          </div>
         
        </div>
      </div>
    </header>
    <div class="main-content">
<br/>
<br/>
<br/>
<center><h3> Login to start your session</h3> </center>
              <div class="container">
               
                <div class="form-horizontal">
                    <div class="form-group">
                    <label dir="ltr" style="float: left;" class = "control-label col-md-2">Username:</label>
                      
                        <div class="col-md-10">
                           <input type="text" id="username" class = "form-control"  />
                        </div>
                    </div>
                
                    <div class="form-group">
                    <label dir="ltr" style="float: left;" class = "control-label col-md-2">Password:</label>
                        <div class="col-md-10">
                           <input type="password" id="password" class = "form-control"  />
                        </div>
                    </div>

                </div>
              </div>
          



    <div>
<center><input type='button' id="loginBtn" value="Login" class="btn btn-primary"/></center>

    </div>
     

    </div>
    <footer class="footer text-center">This project for testing purpose</footer>
    <!--if lt IE 8
    <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    
    
    
    -->
    <!-- Scripts-->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="scripts/jquery.min.js"><\/script>')</script>
    <script src="scripts/bootstrap.min.js"></script>
    <script src="scripts/jquery.smooth-scroll.min.js"></script>
    <script src="scripts/main.js"></script>
    <script src="scripts/toastr.js"></script>
    <script src="scripts/select2.min.js"></script>
    <script>
 $(document).ready(function() {
 
 });


$("#loginBtn").on("click",function(event){
  event.preventDefault();

  var url='<?php $currentPath = $_SERVER['PHP_SELF']; 
$pathInfo = pathinfo($currentPath); 
$hostName = $_SERVER['HTTP_HOST']; 
$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
echo $protocol.'://'.$hostName.$pathInfo['dirname']."/";?>'+"api/login-api.php";
var $username = $("#username").val();
var $password= $("#password").val();

$.ajax(url, {
    type: 'POST',  // http method
    "headers": {
    "content-type": "application/json",
    "cache-control": "no-cache",
  },
  "async": true,
  "crossDomain": true,
  "processData": false,
  "data": "{\n\"username\":\""+$username+" \",\n\"password\": \""+$password+"\"}",
  success: function (data, status, xhr) {
      //  $('p').append('status: ' + status + ', data: ' + data);
      toastr["success"]("<center><h6>Login success</h6></center>",
                        "<center><h5>Success</h5></center>",
                        {
                            "positionClass": "toast-top-full-width",
                            "showDuration": "200",
                            "hideDuration": "1000",
                            "timeOut": "20000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        });
            location.href='<?php echo $_SESSION["bais"]?>Products.php';
                        
    },
    error: function (response) {

          toastr["error"]("<center><h6>"+response["responseJSON"]["message"]+"</h6></center>",
                        "<center><h5>Error</h5></center>",
                        {
                            "positionClass": "toast-top-full-width",
                            "showDuration": "200",
                            "hideDuration": "1000",
                            "timeOut": "20000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        });
    }
});
});
    </script>
  </body>
</html>