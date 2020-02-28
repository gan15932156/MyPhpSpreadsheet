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
         <a href="https://www.w3schools.com/howto/howto_js_accordion.asp">https://www.w3schools.com/howto/howto_js_accordion.asp</a>
       
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

            $html .='<tr class="breakrow" data_wbs="'.$row[1].'"><td>'.$row[0].'</td><td>'.$row[1].'</td></tr>';
            $html .='<tr style="background-color:pink;" id="'.$row[1].'"><td></td><td>'.$row[0].'</td><td>'.$row[1].'</td></tr>';
            

          
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
      }
     /* .accordion {
         background-color: #eee;
         color: #444;
         cursor: pointer;
 
         width: 100%;
         border: none;
         text-align: left;
         outline: none;
         font-size: 15px;
         transition: 0.4s;
      }

      .active, .accordion:hover {
      background-color: #ccc; 
      }

      .panel {
         padding: 0 18px;
         display: none;
         background-color: white;
         overflow: hidden;
         transition: max-height 0.2s ease-out;
      }
      .accordion_symbol:before {
         content: '\02795'; 
         font-size: 13px;
         color: #777;
         float: left;
         margin-left: 5px;
      } */

      /* .active:before {
         content: "\2796";  
      } */
   </style>


   <script>

   

      $(document).ready(function(){
         // var acc = document.getElementsByClassName("accordion");
         // var i;

         // for (i = 0; i < acc.length; i++) {
         // acc[i].addEventListener("click", function() {
         //    this.classList.toggle("active");
         //    var panel = this.nextElementSibling;
         //    if (panel.style.display === "block") {
         //       panel.style.display = "none";
         //    } else {
         //       panel.style.display = "block";
         //    }
            
         // });
         // }
         

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