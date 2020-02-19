<?php require_once("configDB.php"); ?>
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
            <form class="form-inline" id="form_input">
               <div class="form-group">
               <?php   
               $sql = 'SELECT * FROM `task_user` WHERE `user_id` = 3';
                        $conn = $DBconnect;
                        //echo $sql; ?>
                  <select class="form-control" name="select_task" id="select_task">
                     <option value="null_val">เลือกงาน</option>
                     <?php
                        $result = mysqli_query($conn,$sql);
                        while($row = mysqli_fetch_row($result)){
                           echo '<option value="'.$row[0].'">'.$row[2].'</option>';
                        }
                     ?>
                     <!-- <option value="null_val">เลือกงาน</option>
                     <option value="task1">task1</option>
                     <option value="task2">task2</option>
                     <option value="task3">task3</option> -->
                  </select>
                  <input type="file" id="file_input" name="file_input" class="form-control mx-sm-3">
                  <input value="ส่ง" type="button" name="btn_submit" class="btn btn-success" id="btn_submit">
               </div>
              
            </form>
            
         </div>
      </div>
      <div class="row">
         <div class="col-md-1"></div>
         <div class="col-md-9">
            <br>

            <style>
               .result{
                  width:100%;
                  height:80vh;
                  border:1px solid red;
                  overflow:auto;
               }
 
            </style>
            <div class="result">
            </div>
         </div>
         <div class="col-md-2">
            <div class="result_template"></div>
         </div>
      </div>
   </div>
 
   <script>
      $(document).ready(function(){

         var raw_data;

         // field sample
         var json_select1 = {
            h2: "ID",
            h1: "Title",
            h3: "Prefix",
            h4: "Name",
            h5: "University",
            h6: "Type",
            h7: "Awards"
         }

         // input file change
         $("#file_input").change(function(){
            $("#form_input").submit();
         });

         // submit form upload
         $('#form_input').on('submit',function(event){

            event.preventDefault(); 

            $.ajax({  
               url:"read_import_data.php", 
               method:"POST",  
               data:new FormData(this),  
               contentType:false,  
               dataType: 'JSON',
               processData:false, 
               async: false,
               success:function(data){ 

                  // raw data
                  raw_data = data.raw_data;
                  
                  // table html code
                  $(".result").html(data.result_table);
               }  
            }); 
         })

         // on checkbox click (Table header)
         $(document).on("click",".checkcol",function(){

            // check header is checked
            if( $(this).is(':checked') ) {
              
               // change background color
               $(this).parent().css("background-color", "lightgreen");
               $('td[class="'+$(this).val()+'"]').css("background-color", "lightgreen");

               // set check each field table (Task)
               $('input[value="'+$(this).val()+'"]').prop("checked", true);
            }
            else {
               $(this).parent().css("background-color", "");
               $('td[class="'+$(this).val()+'"]').css("background-color", "");

               // set uncheck
               $('input[value="'+$(this).val()+'"]').prop("checked", false);
            }

         })

         // submit file (Confirm upload file)
         $("#btn_submit").click(function(){

            var task_name = $("#select_task").val();
            // object data selected fields
            let dadadsadad = new Object();

            // value in checkbox (Field name)
            let id = [];

            // get all value in checked (Field name)
            $('.checkcol:checkbox:checked').each(function(i){
               id[i] = $(this).val();
            });

            // count checked field template (From database)
            let col_template_count = $('.check_row_template').length;

            // count checked field Table (From user upload)
            let col_file_checked_count = $('.checkcol:checkbox:checked').length;
            
            // check if equal ถ้าผู้ใช้เลือกฟีลด์ตรงตามงาน
            if(col_template_count != col_file_checked_count){
               
            }
            else{

               // Loop user fields selected
               id.forEach(function(key) {

                  // populate data each field (From user selected)
                  dadadsadad[key] = raw_data[key];
               })
 
               $.ajax({  
                  url:"get_upload_data.php", 
                  method:"POST",  
                  data:{ 
                     data: JSON.stringify(dadadsadad) ,
                     task_name : task_name
                  },  
                  dataType: 'JSON', 
                  async: false,
                  success:function(data){ 
                     console.log(data)
                  }  
               }); 
                
            }
            
         }) 

         // on Task(ตารางงาน) selectbox change
         $("#select_task").change(function(){

            // clear checkbox div
            $(".result_template").empty();

            // HTML code
            html= '';
            
            if($(this).val() != "null_val"){

               $.ajax({  
                  url:"get_tempalte_task.php", 
                  method:"POST",  
                  data:{ 
                    task_id:$(this).val()
                  },  
                  dataType: 'JSON', 
                  async: false,
                  success:function(data){ 
                     if(!data.error){
                        html = data.result;
                     }
                     else{
                        alert(data.message)
                     }
                  }  
               }); 
            }
 
            
            $(".result_template").html(html);
            
         });

      })
   </script>      
</body>
</html>