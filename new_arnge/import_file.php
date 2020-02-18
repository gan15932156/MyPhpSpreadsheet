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
                  <select class="form-control" name="select_task" id="select_task">
                     <option value="null_val">เลือกงาน</option>
                     <option value="task1">task1</option>
                     <option value="task2">task2</option>
                     <option value="task3">task3</option>
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

         var json_select1 = {
            h2: "ID",
            h1: "Title",
            h3: "Prefix",
            h4: "Name",
            h5: "University",
            h6: "Type",
            h7: "Awards"
         }
         $("#file_input").change(function(){
            $("#form_input").submit();
         });

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

                  raw_data = data.raw_data;
                  
                  $(".result").html(data.result_table);
               }  
            }); 
         })

         $(document).on("click",".checkcol",function(){

            if( $(this).is(':checked') ) {
              
               $(this).parent().css("background-color", "lightgreen");
               $('td[class="'+$(this).val()+'"]').css("background-color", "lightgreen");

               $('input[value="'+$(this).val()+'"]').prop("checked", true);
            }
            else {
               $(this).parent().css("background-color", "");
               $('td[class="'+$(this).val()+'"]').css("background-color", "");

               $('input[value="'+$(this).val()+'"]').prop("checked", false);
            }

         })

         $("#btn_submit").click(function(){
            let dadadsadad = new Object();
            let id = [];

            $('.checkcol:checkbox:checked').each(function(i){
               id[i] = $(this).val();
            });

            let col_template_count = $('.check_row_template').length;

            let col_file_checked_count = $('.checkcol:checkbox:checked').length;
            
          /*  if(col_template_count != col_file_checked_count){
               alert("please select")
            }
            else{*/
               id.forEach(function(key) {
                  dadadsadad[key] = raw_data[ key];
                  //dadadsadad.push(raw_data[ key]);
               })
               console.log(dadadsadad)
           /* }*/
            
         }) 

         $("#select_task").change(function(){
            html= '';
            if($(this).val() == "task1"){
               
               Object.keys(json_select1).forEach(function(key) {
                  html+= '<input class="check_row_template" type="checkbox" id="check_row_template" name="check_row_template[]" value="'+json_select1[key]+'" disabled="disabled" readonly >  <span>'+json_select1[key]+'</span><br>';
               })
            }
            else if($(this).val() == "task2"){
               alert("Adasdasd2")
            }
            else if($(this).val() == "task3"){
               alert("Adasdasd3")
            }
            else{
               alert("please sdasdkasldkask")
            }
            
            $(".result_template").html(html);
         });

      })
   </script>      
</body>
</html>