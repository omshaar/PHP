
<?php 
include('Bais.php');
include('Header.php');
?>

    <div class="main-content">
    <div id="product-box" class="box">
    <h3 class="box-title col-md-6">Products</h3>
    <br/>
    <br/>
    <br/>
    <div class="container">
               
               <div class="form-horizontal">
                   <div class="form-group">
                   <label dir="ltr" style="float: left;" class = "control-label col-md-4">Filter by category:</label>
                     
                       <div class="col-md-8">
                       <select  id="categories" class = "form-control basic-multiple col-md-6" multiple="multiple">   </select>
                       </div>
                   </div>
</div>
</div>



    <div class="form-group col-md-12"> 
         <a href='<?php echo $_SESSION["bais"]?>createProduct.php' class="btn btn-success btn-md col-md-4">
         <span class="fa fa-plus" aria-hidden="true"></span> Add New Product
        </a> 
        
        </div>
      
                      
    <br/>
    <br/>
    <br/>
    <div class="box-body">
        <table class="table table-bordered table-hover table-striped" id="product-table">
            <thead>
            <tr>

                <th>
                   
                </th>
                <th>
                   
                </th>
                <th>
                   
                </th>
               
                <th></th>
               
            </tr>
            </thead>

            <tbody></tbody>


        </table>
    </div>
</div>
    </div>
    <footer class="footer text-center">This project for testing purpose</footer>
   <!-- Conferm modal-->
<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <p>you sure you want to delete this...! </p>
        <input type="hidden" id="productId" name="productId">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="deleteCofirm">Delete</button>
      </div>
    </div>
  </div>
</div>

  <?php
  include('Scripts.php');
  ?>
    <script>
        var ProductList;
       var baisUrl='<?php echo $_SESSION["bais"]?>';
 $(document).ready(function() {
    $('.basic-multiple').select2({maximumSelectionLength: 1}); 
    var urlSelect='<?php $currentPath = $_SERVER['PHP_SELF']; 
$pathInfo = pathinfo($currentPath); 
$hostName = $_SERVER['HTTP_HOST']; 
$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
echo $protocol.'://'.$hostName.$pathInfo['dirname']."/";?>'+"api/category_api.php";
var $Auth= '<?php echo $_SESSION["token"];?>';
$.ajax(urlSelect, {
    type: 'GET',  // http method
    "headers": {
    "content-type": "application/json",
    "cache-control": "no-cache",
    "Authorization": $Auth
  },
  "async": true,
  "crossDomain": true,
  "processData": false,
  success: function (data, status, xhr) {
     
                        $('#categories').empty();
        var $select = $('#categories');
        $.each(data["data"],
            function(i, item) {
                $('<option>',
                    {
                        value: item.id
                    }).html(item.name).appendTo($select);
            });
  },
  error: function (response) {
          toastr["error"]("<center><h6>"+JSON.stringify(response)+"</h6></center>",
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



var $category = $(".basic-multiple").val();
if($category==null)
$category='';
 // var urll='<?php echo $_SESSION["bais"]?>'+"api/product_api.php";
  var urll='<?php echo $_SESSION["bais"]?>'+"api/filter_api.php?filter="+$category;
  ProductList = $('#product-table').DataTable({
                
                ajax: {
                  processing: true,
                    url: urll,
                    type: "GET",
                    error: function (xhr, error, thrown) {

                        alert("Connection is lost, please check your connection and refresh page!")
                    }
                },
                columns: [
                    {
                        data: "name",
                        title: "name",
                         "searchable": true
                    },
                    {
                        data: "price",
                        title: "price"
                        , "searchable": true
                    },
                    {
                        data: "description",
                        title: "description"
                        
                    },
                     
                    {
                        "width": "18%",
                        "title": "Action",
                        "data": "id",
                        "searchable": false,
                        "sortable": false,
                        "render": function (data, type, full) {
                           
                               return '<a href="'+baisUrl+'/EditProduct.php?id=' +
                                    data +
                                    '" class="btn btn-success"><span class="fa fa-edit"></span> Edit</a> '+ 
                                 '<a href="'+
                                    data +
                                   '"class="btn btn-danger deleteProduct"><span class="fa fa-times"></span> Delete</a> ' ;
                        }
                    }
                ],
                columnDefs: [
                    {
                        "targets": -1,
                        "data": null,
                        "defaultContent": "<div class = 'btn-group'>" +
                            "<button> Deactive</button" +
                            "</div>"
                    }
                ],
                drawCallback: function () {
             
                },
                preDrawCallback: function () {
                   
                }

            });

            $('#product-table tbody').on("click",
                ".deleteProduct",
                function (event) {
                    event.preventDefault();

                    var id = $(this).attr("href"); 
                    $("#productId").val(id);

                            $('#deleteModal').modal('show');
 
                });

 });

 $("#deleteCofirm").on("click",function(event){
  event.preventDefault();
  var $Auth= '<?php echo $_SESSION["token"];?>';
  var $id= $("#productId").val();
  $.ajax(baisUrl+"api/product_api.php", {
    type: 'DELETE',  // http method
    "headers": {
    "content-type": "application/json",
    "cache-control": "no-cache",
    "Authorization": $Auth
  },
  "async": true,
  "crossDomain": true,
  "processData": false,
  "data": "{\n\t\"id\": "+$id+"}",
  success: function (data, status, xhr) {

      toastr["success"]("<center><h6>Delete success </h6></center>",
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
                        $('#deleteModal').modal('hide');  
                        ProductList.ajax.reload(null, false);
                        
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

 $('.basic-multiple').change(function () {
    var $category = $(".basic-multiple").val();
    if($category===null)
    {
        $category=''; 
    }
    var urll='<?php echo $_SESSION["bais"]?>'+"api/filter_api.php?filter="+$category;
    ProductList.ajax.url( urll ).load();
    
 });
    </script>
 <?php
 include('Header.php');
 ?>