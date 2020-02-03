<?php
   include 'configDB.php';
   $conn = $DBconnect;

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Document</title>
  

   
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>



      <!-- Jquery multiselect github ref http://davidstutz.de/bootstrap-multiselect/-->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css" />




   <style>
      *{
         margin : 0;
         padding : 0;
      }
            table{ 
               border:1px solid gray;
               font-family:calibri,verdana,arial;
               float:none;
               margin:auto; 
            }
            th{
               background:gray;
               color:white;
               padding:0.5rem;
            }
            td{
               padding:0.5rem;
               border:1px dotted gray;
            }
            td[colspan]{
               background:whitesmoke;
            }
            .currency:before{
                content:'<?=$symbol;?>';
                color:green;
                font-weight:bold;
            }
        </style>
      <script src="jsonnnnnnn.js"></script>
</head>
<body>
<div class="container">
      <div class="row">
         <div class="col-md-1"></div>
         <div class="col-md-10">
            <div class="row">
               <div class="col-md-12" align="center"><br><br>
                  <button id="test_ajax" class="btn btn-success">Show table</button>
                  <button id="show_subtotal" class="btn btn-success">show_subtotal</button>
               </div>
            </div><br>
            <div class="row">
               <div class="col-md-3">
                  <lable >choose field</label>
               </div>
               <div class="col-md-9">
                  <select name="fields" id="fields" class="form-control" multiple>
                  </select>
               </div>
            </div>
            
  
            <br><br>
               <div id="table_div"> </div>
         </div>
         <div class="col-md-1"></div>
      </div>
   </div>
  
</body>
</html>