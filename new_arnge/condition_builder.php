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
            <table class="table table-bordered table-sm text-center">
               <thead>
                  <tr>
                     <th>Condition</th>
                     <th>Fields</th>
                     <th>Operator</th>
                     <th>Fields/value</th>
                  </tr>
               </thead>
               <tbody> 
      
               
                  <tr>
                     <td><input class="btn btn-primary " type="button" value="submit" id="btn_submit" name="btn_submit"></td>
                     <td> 
                        <select class="form-control" name="select_fields" id="select_fields">
                           <option value="field1">field1</option>
                           <option value="field2">field2</option>
                           <option value="field3">field3</option>
                           <option value="field4">field4</option>
                        </select>
                     </td>
                     <td>
                        <select class="form-control" name="operator_select_box" id="operator_select_box">
                           <option value="equal">=</option>
                           <option value="geater_than">></option>
                           <option value="less_than"><</option>
                           <option value="greater_tha_or_equal_to">>=</option>
                           <option value="less_than_or_equal_to"><=</option>
                        </select>
                     </td>
                     <td></td>
                  </tr>
               </tbody>
            </table>
         </div>
         <div class="col-md-1"></div>
      </div>
   </div>
</body>
</html>