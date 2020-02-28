<!DOCTYPE html>
<html lang="en">
<head>

   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Condition Page</title>

   <?php include_once('include_lib.php'); ?>

   <script src="condition_builder.js"></script>
   
</head>
<body>
   <div class="container">
      <div class="row">
         <div class="col-md-1"></div>
         <div class="col-md-10">
            <br>
            <center><input id="send_request" type="button" class="btn btn-primary" value="ส่ง"></center>
            <br>
            <form id="form_condition">
               <table class="table table-bordered table-sm text-center">
                  <thead>
                     <tr>
                        <th><input class="btn btn-success" type="button" id="add_condition" nmae="add_condition" value="+"></th>
                        <th>ตัวเชื่อม</th>
                        <th>Fields</th>
                        <th>Operator</th>
                        <th>Fields/value</th>
                     </tr>
                  </thead>
                  <tbody id="condition_body"></tbody>
               </table>
            </form>
         </div>
         <div class="col-md-1"></div>
      </div>
      <div class="row">
         <div class="col-md-1"></div>
         <div class="col-md-10">
            <div style="background-color:lightblue;" class="result"></div>
         </div>
         <div class="col-md-1"></div>
      </div>
   </div>
</body>
</html>