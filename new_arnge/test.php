<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <?php include_once('include_lib.php'); ?>
   
   <title>Document</title>
</head>
<body>
   <div class="container"><br>
      <div class="row">
 
         <a href="https://jsfiddle.net/p9mtqhm7/52/">https://jsfiddle.net/p9mtqhm7/52/</a>
      </div>  <br>
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
      <?php

         include("configDB.php");

         $conn = $DBconnect;

         // select count record and substring WBS field GROUP BY WBS Ex. AYY
         $sql = 'SELECT count(*) as count,substr(h3,8,3) as WBS FROM `งบเร่งด่วนมกรา` /*WHERE h2_1 <= 02*/ GROUP BY substr(h3,8,3) ORDER BY `h3`  ASC';

         $result = mysqli_query($conn,$sql);

         $count = 0;

         $html = '<table class="table text-center tb"><thead><tr><th width="10%">#</th><th width="40%">H1</th><th width="50%">H2</th></tr></thead><tbody>';

         while($row = mysqli_fetch_row($result)){

            if($row[1] == ""){
               $html .='<tr class="header" data_wbs="null_value"><td><span>+</span></td><td>'.$row[0].'</td><td>'.$row[1].'</td></tr>';
               $html .='<tr style="background-color:pink;display:none;" id="null_valuey" ><td></td><td>'.$row[0].'</td><td>'.$row[1].'</td></tr>';
               $html .='<tr style="background-color:pink;display:none;" id="null_valuey" ><td></td><td>'.$row[0].'</td><td>'.$row[1].'</td></tr>';
               $html .='<tr style="background-color:pink;display:none;" id="null_valuey" ><td></td><td>'.$row[0].'</td><td>'.$row[1].'</td></tr>';
               $html .='<tr style="background-color:pink;display:none;" id="null_valuey" ><td></td><td>'.$row[0].'</td><td>'.$row[1].'</td></tr>';
            }
            else{
               $html .='<tr class="header" data_wbs="'.$row[1].'"><td><span>+</span></td><td>'.$row[0].'</td><td>'.$row[1].'</td></tr>';
               $html .='<tr style="background-color:pink;display:none;" id="'.$row[1].'" ><td></td><td>'.$row[0].'</td><td>'.$row[1].'</td></tr>';
               $html .='<tr style="background-color:pink;display:none;" id="null_valuey" ><td></td><td>'.$row[0].'</td><td>'.$row[1].'</td></tr>';
            }

            $count+=$row[0];
         }

         $html.= '</tbody><tfoot><tr><td>SUM</td><td>'.$count.'</td></tr></tfoot></table>';

         echo $html;

         ?>
      </div>
   </div>
 
   <style>
      .tb{
         width:50vw;
      }tr.header
{
    cursor:pointer;
}
    
   </style>


   <script>

      //REF https://jsfiddle.net/p9mtqhm7/52/

      $(document).ready(function(){


         $('tr.header').click(function(){

            $(this).find('span').text(function(_, value){return value=='-'?'+':'-'});
            
            $(this).nextUntil('tr.header').slideToggle(50);
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