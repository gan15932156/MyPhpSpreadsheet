<!DOCTYPE html>
<html lang="en">
<head>

   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Import</title>

   <?php include_once('include_lib.php'); ?>

</head>
<body>

   <div class="container-fluid">
      <div class="row">
         <div class="col-md-3">
            <br>
            <form id="form_input">
               <input type="file" id="file_input" name="file_input" class="form-control">
            </form>
            
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="result">
            </div>
         </div>
      </div>
   </div>
      



   <script>
      $(document).ready(function(){
         
         $("#file_input").change(function(){
            $("#form_input").submit();
         });

         $('#form_input').on('submit',function(event){
            event.preventDefault(); 
            $.ajax({  
                  url:"read_import_data.php", 
                  method:"POST",  
                  data:new FormData(this),  
                  dataType: "JSON",
                  contentType:false,  
                  processData:false, 
                  async: false,
                  success:function(data){ 
                     console.log(data)
                     $(".result").html(data);
                  }  
               }); 
         })
      })
   </script>      
</body>
</html>