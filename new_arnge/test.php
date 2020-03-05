<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <?php 
      include_once('include_lib.php'); 
      include_once("configDB.php");

      $conn = $DBconnect;
   ?>
   
   <title>Document</title>
</head>
<body>
   <div class="container"><br>
      <div class="row">
 
         <a href="https://jsfiddle.net/p9mtqhm7/52/">https://jsfiddle.net/p9mtqhm7/52/</a>
      </div>  <br>
      <div class="row">
      <?php
               $task_sql = 'SELECT * FROM `task_user` WHERE user_id = 3';
               //echo $task_sql;
               $task_result = mysqli_query($conn,$task_sql);

               
            ?>
         <select name="user_task" id="user_task" class="form-control col-md-6">
            <option value="null_task">เลือกงาน</option>
            <?php
               while($row_task = mysqli_fetch_row($task_result)){
                  echo '<option value="'.$row_task[2].'">'.$row_task[2].'</option>';
               }
            ?>
         </select>

         <input id="send_request" type="button" class=" btn btn-success " value="ส่ง">
      </div>
      <!-- <div class="row">

         <button class="accordion">Section 1</button>
         <div class="panel">
         <p>Lorem ipsum...</p>
         </div>

         <button class="accordion">Section 2</button>
         <div class="panel">
         <p>Lorem ipsum...</p>
         </div>

         <button class="accordion">Section 3</button>
         <div class="panel">
         <p>Lorem ipsum...</p>
         </div>

      </div> -->
      
      
      <br><br><br>
      <div class="row">
      <div class="result_table"></div>
         <form id="form_test">
            <?php

                  

            // select count record and substring WBS field GROUP BY WBS Ex. AYY
            $sql = 'SELECT count(*) as count,substr(h3,8,3) as WBS FROM `งบเร่งด่วนมกรา` /*WHERE h2_1 <= 02*/ GROUP BY substr(h3,8,3) ORDER BY `h3`  ASC';

            $result = mysqli_query($conn,$sql);

            $count = 0;

            $html = '<table class="table text-center table-bordered tb"><thead><tr><th width="10%">#</th><th width="10%"><input class="checkall" type="checkbox" name="checkall" value="checkall"></th><th width="50%">Count</th><th width="30%">WBS</th></tr></thead><tbody>';

            while($row = mysqli_fetch_row($result)){

               $sql_whiel = 'SELECT * FROM `งบเร่งด่วนมกรา` WHERE substr(h3,8,3) = "'.$row[1].'"';

               $result2 = mysqli_query($conn,$sql_whiel);


               if($row[1] == ""){
                  $html .='<tr class="header" data_wbs="null_value"><td><span class="btn btn-primary btn-sm">+</span></td><td><input class="checkcol cb-element" type="checkbox" name="checkcol[]" value="'.$row[1].'"></td><td>'.$row[0].'</td><td>'.$row[1].'</td></tr>';
                  while($row2 = mysqli_fetch_row($result2)){
                     //print_r($row2)."\n";
                     $html .='<tr style="background-color:pink;display:none;"><td></td><td>'.$row2[1].'</td><td class="text-left">'.$row2[2].''.$row2[3].'</td><td>'.$row2[4].'</td></tr>';
                  }
               }
               else{
                  $html .='<tr class="header" data_wbs="'.$row[1].'"><td><span class="btn btn-primary btn-sm">+</span></td><td><input class="checkcol cb-element" type="checkbox" name="checkcol[]" value="'.$row[1].'"></td><td>'.$row[0].'</td><td>'.$row[1].'</td></tr>';
                  while($row2 = mysqli_fetch_row($result2)){
                     //print_r($row2)."\n";
                     $html .='<tr style="background-color:pink;display:none;"><td></td><td>'.$row2[1].'</td><td class="text-left">'.$row2[2].''.$row2[3].'</td><td>'.$row2[4].'</td></tr>';
                  }

               }

               $count+=$row[0];
            }

            $html.= '</tbody><tfoot><tr><td colspan="3">SUM</td><td>'.$count.'</td></tr></tfoot></table>';

            echo $html;

            ?>
               
         </form>
         
      </div>
   </div>
 
   <style>
      .tb{
         width:70vw;
      }
     
    
   </style>


   <script>

      //REF https://jsfiddle.net/p9mtqhm7/52/

      $(document).ready(function(){
         $("#send_request").click(function(){
            $.ajax({
                  url: "get_request.php",
                  method: "POST",
                  async: false,
                  //dataType: "JSON", // response variable type
                  data: $('#form_test').serialize(), // get form data
                  error: function(jqXHR, text, error) {
                     alert(error)
                  }
               })
               .done(function(data) { // response
                  console.log(data)
                     
               });
         });
         
         $('.checkall').click(function(){

            if($(this).is(':checked')){

               $('.checkcol').each(function(){

                  $(this).attr( 'checked', true )
                  
               });

            }
            else{

               $('.checkcol').each(function(){

                  $(this).attr( 'checked', false )

               });
            }
          
         });

         $('#user_task').change(function(){

            if($('#user_task').val() != "null_task"){

               $.ajax({
                  url: "sekect_task_data.php",
                  method: "POST",
                  async: false,
                  dataType: "JSON", // response variable type
                  data: {task_name : $('#user_task').val()}, // get form data
                  error: function(jqXHR, text, error) {
                     alert(error)
                  }
               })
               .done(function(data) { // response
                  console.log(data)
                  $('.result_table').html(data)
               });
            }
           
         });

         $('tr.header td span').click(function(){
 
            $(this).parent().find('span').text(function(_, value){return value=='-'?'+':'-'});
            
            $(this).parent().parent().nextUntil('tr.header').slideToggle(50);
         });


         var key_wbs = new Object();

         $(".tb tbody tr").each(function(k,v){

            let td_value = $(this).find("td")[0].innerText;

            if($(this).attr("data_wbs") == ""){

               key_wbs["null_val"] = td_value;

            }
            else{
               
               key_wbs[$(this).attr("data_wbs")] = td_value;
            }
            
      
            //console.log(td_value)
         });

         //console.log(key_wbs)

         $(".tb tbody tr").click(function(){
            let wbs = $(this).attr("data_wbs");
            
            if(wbs == ""){
               //console.log(key_wbs["null_val"])
            }
            else{
               //console.log(key_wbs[wbs])
            }
            
         });
      });
   </script>
</body>
</html>