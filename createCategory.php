<!DOCTYPE html>
<?php session_start();
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
    <!-- if lt IE 9
    script(src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js")
    script(src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js")
    
    -->
    <!-- stylesheets-->
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
           
          </div>
          <div id="navbar-collapse-1" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
            <li><a href='<?php echo $_SESSION["bais"]?>Products.php'>Products</a></li>
              <li><a href='<?php echo $_SESSION["bais"]?>Categories.php'>Categories</a></li>>
            </ul>
          </div>
        </div>
      </div>
    </header>
    <div class="main-content">
<br/>
<br/>
<br/>
<center><h3> Create New Product</h3> </center>
              <div class="container">
               
                <div class="form-horizontal">
                    <div class="form-group">
                    <label dir="ltr" style="float: left;" class = "control-label col-md-2">Name:</label>
                      
                        <div class="col-md-10">
                           <input type="text" id="name" class = "form-control"  />
                        </div>
                    </div>
 
                    <div class="form-group">
                    <label dir="ltr" style="float: left;" class = "control-label col-md-2">Description:</label>
                        <div class="col-md-10">
                        <textarea id="description" name="description" rows="4" cols="50" class="form-control">
                      
                        </textarea>
                        </div>
                    </div>

                   
                </div>
              </div>
          



    <div>
<center><input type='button' id="createBtn" value="Create" class="btn btn-success"/></center>

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


$("#createBtn").on("click",function(event){
  event.preventDefault();
  var $name = $("#name").val();
var $description= $("#description").val();

  var url='<?php $currentPath = $_SERVER['PHP_SELF']; 
$pathInfo = pathinfo($currentPath); 
$hostName = $_SERVER['HTTP_HOST']; 
$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
echo $protocol.'://'.$hostName.$pathInfo['dirname']."/";?>'+"api/category_api.php";
var $name = $("#name").val();
var $description= $("#description").val();
var $Auth= '<?php echo $_SESSION["token"];?>';
$.ajax(url, {
    type: 'POST',  // http method
    "headers": {
    "content-type": "application/json",
    "cache-control": "no-cache",
    "Authorization": $Auth
  },
  "async": true,
  "crossDomain": true,
  "processData": false,
  "data": "{\n\"name\":\""+$name+" \",\n\"description\": \""+$description+"\"}",
  success: function (data, status, xhr) {

      //  $('p').append('status: ' + status + ', data: ' + data);
      toastr["success"]("<center><h6>"+data["message"]+"</h6></center>",
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